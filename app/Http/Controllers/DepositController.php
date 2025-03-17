<?php

namespace App\Http\Controllers;

use App\Libraries\Paydisini;
use App\Libraries\Tripay;
use App\Models\Bot;
use App\Models\Config;

use App\Models\Deposit;
use App\Models\MetodePembayaran;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use iPaymu\iPaymu;

class DepositController extends Controller
{
    public function deposit()
    {
        return view('deposit.new');
    }
    public function get_methode(Request $request)
    {
        $channel = MetodePembayaran::where('type_payment', $request->id)->where('status', 'active')->orderBy('name', 'asc')->get();

        if ($channel->first()) {
            return response()->json([
                'status' => true,
                'html' => view('deposit.metode', compact('channel'))->render(),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran tidak tersedia...',
            ]);
        }
    }
    public function get_bonus(Request $request)
    {
        $metode = MetodePembayaran::find($request->id);
        return view('deposit.bonus', compact('metode'));
    }
    public function get_fee(Request $request)
    {
        $channel = MetodePembayaran::where('id', $request->metod)->first();
        if ($request->_token) {
            if ($channel) {
                if ($channel->rate_type == 'fixed') {
                    $jmlh = 'Rp ' . number_format($request->nominal, 0, ",", ".") . ' + Tax system';
                    $tax = ' + Tax System';
                    $rt = number_format($channel->rate, 0, ",", ".");
                } else {
                    $fee = ($request->nominal / 100) * $channel->rate;
                    $jmlh = 'Rp ' . number_format($request->nominal + $fee, 0, ",", ".");
                    $tax = '';
                    $rt = $channel->rate . '%';
                }
                if ($channel->bonus != null && $channel->bonus != '[]') {
                    $decode = json_decode($channel->bonus, true);
                    $closest_nominal = 0;
                    $bonus = 0;
                    $decode = json_decode($channel->bonus, true);

                    usort($decode, function ($a, $b) {
                        return $a['min_nominal'] - $b['min_nominal'];
                    });

                    $bonus = $request->nominal;
                    $tax = '';
                    $closest_nominal = 0;

                    foreach ($decode as $item) {
                        $min_nominal = (int)$item['min_nominal'];
                        $nominal = (int)$item['nominal'];
                        if ($request->nominal >= $min_nominal && $min_nominal > $closest_nominal) {
                            $closest_nominal = $min_nominal;
                            $currentBonus = ($request->nominal / 100) * $nominal;
                            $bonus = $request->nominal + $currentBonus;
                            $tax = ' + ( Bonus ' . $nominal . '% )';
                        }
                    }
                } else {
                    $bonus = $request->nominal;
                }
                return response()->json([
                    'status' => true,
                    'get' => 'Rp ' . number_format($bonus, 0, ",", ".") . $tax,
                    'jmlh' => $jmlh,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Pembayaran tidak tersedia...',
                ]);
            }
        } else {
            echo 'No direct script access allowed';
        }
    }
    public function proses_deposit(Request $request)
    {
        $metode = MetodePembayaran::find($request->method);
        $trxid = 'DEP' . time();
        $bot = Bot::where('user_id', Auth::user()->id)->where('type', 'whatsapp')->where('status', '1')->first();
        if ($metode) {
            $deposit = Deposit::where('user_id', auth()->user()->id)->where('status', 'pending')->first();
            if ($deposit) {
                return redirect()->back()->with('error', 'Anda masih memiliki transaksi yang belum selesai');
            } else {
                if ($request->nominal < $metode->min_nominal && $metode->min_nominal != 0) {
                    return redirect()->back()->with('error', 'Minimal deposit Rp ' . number_format($metode->min_nominal, 0, ",", "."));
                } elseif ($request->nominal > $metode->max_nominal && $metode->max_nominal != 0) {
                    return redirect()->back()->with('error', 'Maksimal deposit Rp ' . number_format($metode->max_nominal, 0, ",", "."));
                } else {
                    if ($metode->rate_type == 'fixed') {
                        $fee = $metode->rate;
                        $fee = $request->nominal + $fee;
                    } else {
                        $fee = ($request->nominal / 100) * $metode->rate;
                        $fee = $request->nominal + $fee;
                    }
                    $rand = 0;
                    if ($metode->type_proses == 'manual') {
                        $rand = rand(1, 99);
                        $fee = $fee + $rand;
                    }
                    $fee = ceil($fee);
                    $diterima = $request->nominal;

                    if ($metode->bonus != null && $metode->bonus != '[]') {
                        $decode = json_decode($metode->bonus, true);
                        $closest_nominal = 0;
                        $bonus = 0;
                        $decode = json_decode($metode->bonus, true);

                        usort($decode, function ($a, $b) {
                            return $a['min_nominal'] - $b['min_nominal'];
                        });

                        $bonus = $request->nominal;
                        $tax = '';
                        $closest_nominal = 0;

                        foreach ($decode as $item) {
                            $min_nominal = (int)$item['min_nominal'];
                            $nominal = (int)$item['nominal'];
                            if ($request->nominal >= $min_nominal && $min_nominal > $closest_nominal) {
                                $closest_nominal = $min_nominal;
                                $currentBonus = ($request->nominal / 100) * $nominal;
                                $diterima = $request->nominal + $currentBonus + $rand;
                                $tax = ' + ( Bonus ' . $nominal . '% )';
                            }
                        }
                    } else {
                        $diterima = $request->nominal;
                    }
                    try {
                        if (strtolower($metode->provider) == 'tripay') {
                            $config = Config::first();
                            if ($config) {
                                $decode = json_decode($config->provider_payment, true);
                                $tripay = $decode['tripay'];
                                $qris = new Tripay;
                                $qris = $qris->production($trxid, $metode->code, $fee, ['id' => Auth::user()->id]);
                                $decode = json_decode($qris);
                                if ($decode->success == true) {
                                    Deposit::create([
                                        'user_id' => auth()->user()->id,
                                        'trxid' => $trxid,
                                        'process' => $metode->type_proses,
                                        'code' => $metode->type_payment,
                                        'name_payment' => $metode->name,
                                        'account_number' => Str::lower($metode->account_number),
                                        'description' => $metode->description,
                                        'amount' => $fee,
                                        'diterima' => $diterima,
                                        'expired' => Carbon::now()->addHours(2),
                                        'payment_url' => $decode->data->checkout_url,
                                        'status' => 'pending',
                                    ]);
                                    if ($bot) {
                                        if ($bot->switch_deposit == '1') {
                                            $data = [
                                                'order_id' => $trxid,
                                                'channel' => $metode->name,
                                                'nominal' => 'Rp ' . number_format($fee, 0, ",", "."),
                                                'expired' => Carbon::now()->addHours(2)->format('d-m-Y H:i:s'),
                                            ];
                                            Senderwhatsapp('notif_deposit', $data);
                                        }
                                    }
                                    setcookie('invoice', $trxid, time() + 7200, '/');
                                    return redirect('deposit/invoice/' . $trxid);
                                } else {
                                    return redirect()->back()->with('error', 'Gagal memproses pembayaran');
                                }
                            } else {
                                return redirect()->back()->with('error', 'Pembayaran tidak tersedia...');
                            }
                        } elseif (strtolower($metode->provider) == 'paydisini') {
                            $paydisini = new Paydisini();
                            $order = json_decode($paydisini->create($trxid, $metode->code, $fee, 3600 * 2, 00));
                            if ($order->success == true) {
                                Deposit::create([
                                    'user_id' => auth()->user()->id,
                                    'trxid' => $trxid,
                                    'process' => $metode->type_proses,
                                    'code' => $metode->type_payment,
                                    'name_payment' => $metode->name,
                                    'account_number' => Str::lower($metode->account_number),
                                    'description' => $metode->description,
                                    'amount' => $fee,
                                    'diterima' => $diterima,
                                    'expired' => Carbon::now()->addHours(2),
                                    'payment_url' => $order->data->checkout_url_v2 ?? null,
                                    'status' => 'pending',
                                ]);

                                if ($bot) {
                                    if ($bot->switch_deposit == '1') {
                                        $data = [
                                            'order_id' => $trxid,
                                            'channel' => $metode->name,
                                            'nominal' => 'Rp ' . number_format($fee, 0, ",", "."),
                                            'expired' => Carbon::now()->addHours(2)->format('d-m-Y H:i:s'),
                                        ];
                                        Senderwhatsapp('notif_deposit', $data);
                                    }
                                }
                                setcookie('invoice', $trxid, time() + 7200, '/');
                                return redirect('deposit/invoice/' . $trxid);
                            } else {
                                return redirect()->back()->with('error', 'Gagal memproses pembayaran, silahkan hubungi customer service melalui tiket');
                            }
                        } elseif (strtolower($metode->provider) == 'ipaymu') {
                            $iPaymu = new iPaymu(true);
                            $iPaymu->setURL([
                                'ureturn' => url('return-invoice'),
                                'unotify' => url('api/callback/ipaymu'),
                                'ucancel' => url('cancel/transaksi'),
                            ]);
                            $iPaymu->setBuyer([
                                'name' => Auth::user()->name,
                                'phone' => Auth::user()->whatsapp,
                                'email' => Auth::user()->email,
                            ]);
                            $data = [
                                'referenceId' => $trxid,
                                'paymentMethod' => $metode->code,
                                'expired' => 2,
                            ];
                            $carts = $iPaymu->add((string) $trxid, 'Deposit balance panel', $request->nominal, 1, 'Deposit balance Rp ' . number_format($request->nominal, 0, ",", "."),);
                            $order = json_decode($iPaymu->redirectPayment($data));
                            if ($order->Status == 200 && $order->Success == true) {
                                return redirect($order->Data->Url);
                            }
                        } else {
                            Deposit::create([
                                'user_id' => auth()->user()->id,
                                'trxid' => $trxid,
                                'process' => $metode->type_proses,
                                'code' => $metode->type_payment,
                                'name_payment' => $metode->name,
                                'account_number' => Str::lower($metode->account_number),
                                'description' => $metode->description,
                                'amount' => $fee,
                                'diterima' => $diterima,
                                'expired' => Carbon::now()->addHours(2),
                                'status' => 'pending',
                            ]);

                            if ($bot) {
                                if ($bot->switch_deposit == '1') {
                                    $data = [
                                        'order_id' => $trxid,
                                        'channel' => $metode->name,
                                        'nominal' => 'Rp ' . number_format($fee, 0, ",", "."),
                                        'expired' => Carbon::now()->addHours(2)->format('d-m-Y H:i:s'),
                                    ];
                                    Senderwhatsapp('notif_deposit', $data);
                                }
                            }
                            return redirect('deposit/invoice/' . $trxid);
                        }
                    } catch (Exception $e) {
                        return redirect()->back()->with('error', 'Gagal memproses pembayaran, silahkan hubungi customer service melalui tiket');
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', 'Pembayaran tidak tersedia...');
        }
    }
    public function invoice(Deposit $deposit)
    {
        $channel = MetodePembayaran::where('name', $deposit->name_payment)->first();
        if ($channel && $deposit->user_id == Auth::user()->id) {
            return view('deposit.invoice', compact('deposit', 'channel'));
        } else {
            abort(404);
        }
    }
    public function cancel(Request $request)
    {
        $deposit = Deposit::where([['trxid', $request->trxid], ['user_id', Auth::user()->id], ['status', 'pending']])->first();
        if ($deposit) {
            return view('deposit.cancel', compact('deposit'));
        } else {
            return '<div class="alert alert-danger">Transaksi tidak ditemukan</div>';
        }
    }
    public function update_status_deposit(Request $request)
    {
        $deposit = Deposit::where([['trxid', $request->id], ['user_id', Auth::user()->id], ['status', 'pending']])->first();
        if ($deposit) {

            $password = $request->password;
            $hash = Auth::user()->password;
            if (password_verify($password, $hash)) {
                $metode = MetodePembayaran::where([['code', $deposit->code], ['name', $deposit->name_payment]])->first();
                $deposit->update([
                    'status' => 'canceled',
                ]);
                return redirect()->route('invoice', $deposit->trxid)->with('success', 'Transaksi berhasil dibatalkan');
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->route('invoice', $request->id)->with('error', 'Transaksi tidak ditemukan');
        }
    }
    public function history()
    {
        return view('deposit.history');
    }
}
