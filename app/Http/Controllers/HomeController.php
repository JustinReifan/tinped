<?php

namespace App\Http\Controllers;

use App\Libraries\Paydisini;
use App\Libraries\Tripay;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\HistoryOrder;
use App\Models\Landing;
use App\Models\MetodePembayaran;
use App\Models\Rating;
use App\Models\Smm;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function listLayanan(Request $request)
    {
        $category = $request->category;
        return view('user.list_layanan', compact('category'));
    }
    public function ketentuanLayanan()
    {
        return view('user.ketentuan-layanan');
    }
    public function contohPesanan()
    {
        return view('user.contoh-pesanan');
    }
    public function kontak()
    {
        return view('user.kontak');
    }

    public function pemesanan()
    {
        $landing = Landing::first();
        $decode = json_decode($landing->page_one, true);
        $page = $decode['order'] ?? null;
        if ($page ?? null == "1") {
            return view('user.pemesanan');
        } else {
            return abort(404);
        }
    }
    public function get_methode(Request $request)
    {
        $channel = MetodePembayaran::where('type_payment', $request->id)->where('status', 'active')->orderBy('name', 'asc')->get();
        if ($channel->first()) {
            return response()->json([
                'status' => true,
                'html' => view('home.pembayaran', compact('channel'))->render(),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran tidak tersedia...',
            ]);
        }
    }
    public function prosesOrder(Request $request)
    {
        $request->validate(
            [
                'layanan' => 'required',
                'email' => 'required',
                'target' => 'required',
                'quantity' => 'required|numeric',
                'method' => 'required',
            ],
            [
                'layanan.required' => 'Layanan tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'target.required' => 'Target tidak boleh kosong',
                'quantity.required' => 'Jumlah tidak boleh kosong',
                'quantity.numeric' => 'Jumlah harus berupa angka',
                'method.required' => 'Metode pembayaran tidak boleh kosong',
            ]
        );
        $ip = $request->ip();
        $smm = Smm::where('service', $request->layanan)->first();
        $metode = MetodePembayaran::find($request->method);
        if (!$smm) {
            return redirect()->back()->wtih('error', 'Layanan tidak ditemukan');
        } elseif (!$metode) {
            return redirect()->back()->with('error', 'Metode pembayaran tidak ditemukan');
        } else {
            $total = ($smm->price / 1000) * $request->quantity;
            $total = ceil($total);
            if ($request->quantity < $smm->min) {
                return redirect()->back()->with('error', $smm->name . ' <br> Minimal order : ' . $smm->min);
            } elseif ($request->quantity > $smm->max) {
                return redirect()->back()->with('error', $smm->name . '<br> Maksimal order : ' . $smm->max);
            } elseif ($total < $metode->min_nominal) {
                return redirect()->back()->with('error', 'Minimal order dengan payment ' . $metode->name . ' adalah : Rp ' . number_format($metode->min_nominal, 0, ',', '.'));
            } elseif ($total > $metode->max_nominal) {
                return redirect()->back()->with('error', 'Maksimal order dengan payment ' . $metode->name . ' adalah : Rp ' . number_format($metode->max_nominal, 0, ',', '.'));
            } else {
                if ($metode->rate_type == 'fixed') {
                    $total = (int) $total;
                    $fee = $metode->rate;
                    $fee = $total + $fee;
                } else {
                    $fee = ($total / 100) * $metode->rate;
                    $fee = $total + $fee;
                }
                $fee = ceil($fee);
                $trxid = 'T' . random2(15);
                $orderid = 'T' . random2(15);
                $data = [
                    'email' => $request->email,
                ];
                try {
                    if (strtolower($metode->provider) == 'tripay') {
                        $tripay = new Tripay;
                        $tripay = $tripay->production($trxid, $metode->code, $fee, $data, url('invoice/' . $trxid));
                        $decode = json_decode($tripay);
                        if ($decode->success == true) {
                            HistoryOrder::create([
                                'ip_address' => $ip,
                                'trxid' => $trxid,
                                'orderid' => $orderid,
                                'email' => $request->email,
                                'provider' => $smm->provider,
                                'type' => $smm->type,
                                'service_id' => $smm->service,
                                'layanan' => $smm->name,
                                'target' => $request->target,
                                'quantity' => $request->quantity,
                                'price' => $fee,
                                'start_count' => 0,
                                'remains' => 0,
                                'refill' => $smm->refill == null ? '0' : '1',
                                'payment_url' => $decode->data->checkout_url,
                                'expired_at' => Carbon::now()->addHours(2),
                                'payment_id' => $metode->id,
                                'status' => 'pending',
                            ]);
                            return redirect('invoice/' . $trxid);
                        } else {
                            return redirect()->back()->with('error', 'Gagal memproses pembayaran');
                        }
                    } elseif (strtolower($metode->provider) == 'paydisini') {
                        $paydisini = new Paydisini();
                        $order = json_decode($paydisini->create($trxid, $metode->code, $fee, 3600 * 2, 00));
                        if ($order->success == true) {
                            HistoryOrder::create([
                                'ip_address' => $ip,
                                'trxid' => $trxid,
                                'orderid' => $orderid,
                                'email' => $request->email,
                                'provider' => $smm->provider,
                                'type' => $smm->type,
                                'service_id' => $smm->service,
                                'layanan' => $smm->name,
                                'target' => $request->target,
                                'quantity' => $request->quantity,
                                'price' => $fee,
                                'start_count' => 0,
                                'remains' => 0,
                                'refill' => $smm->refill == null ? '0' : '1',
                                'payment_url' => $order->data->checkout_url_v2 ?? null,
                                'payment_id' => $metode->id,
                                'expired_at' => Carbon::now()->addHours(2),
                                'status' => 'pending',
                            ]);
                            // setcookie()
                            setcookie('invoice', $trxid, time() + 7200, '/');
                            return redirect('invoice/' . $trxid);
                        } else {
                            return redirect()->back()->with('error', 'Gagal memproses pembayaran');
                        }
                    } else {
                        HistoryOrder::create([
                            'ip_address' => $ip,
                            'trxid' => $trxid,
                            'orderid' => $orderid,
                            'email' => $request->email,
                            'provider' => $smm->provider,
                            'type' => $smm->type,
                            'service_id' => $smm->service,
                            'layanan' => $smm->name,
                            'target' => $request->target,
                            'quantity' => $request->quantity,
                            'price' => $fee,
                            'start_count' => 0,
                            'remains' => 0,
                            'refill' => $smm->refill == null ? '0' : '1',
                            'payment_id' => $metode->id,
                            'status' => 'pending',
                        ]);
                        return redirect('invoice/' . $trxid);
                    }
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Gagal memproses pembayaran');
                }
            }
        }
    }
    public function invoice($trxid)
    {
        $invoice = HistoryOrder::with('payment')->where('trxid', $trxid)->first();
        if (!$invoice) {
            return abort(404);
        }
        return view('home.invoice', compact('trxid', 'invoice'));
    }
    public function filterCategory(Request $request)
    {
        if ($request->category == 'Semua') {
            $service  = Category::where('nologin', '1')->orderBy('kategori', 'asc')->get();
        } else {
            $service = Category::where([['kategori', 'like', '%' . $request->category . '%'], ['nologin', '1']])->orderBy('kategori', 'asc')->get();
        }
        if ($service->first()) {
            printf('<option value="%s"  selected disabled>%s</option>', '0', 'Pilih Category');
            foreach ($service as $row) {
                $smm = Smm::where('category', $row->kategori)->orderBy('price', 'asc')->first();
                if ($smm) {
                    printf(
                        '<option data-icon="%s" value="%s">%s</option>',
                        htmlspecialchars('<i class="' . e($row->icon) . '"></i>'), // Escape $icon
                        e($smm->id),                                         // Escape $value->id
                        e($row->kategori)                                           // Escape $replace
                    );
                }
            }
        } else {
            return '<option value="0">Layanan tidak tersedia</option>';
        }
    }
    public function getLayanan(Request $request)
    {
        $id = Smm::find($request->id);
        if ($id) {
            $category = Smm::where([['category', $id->category], ['status', 'aktif']])->orderBy('price', 'asc')->get();
            printf('<option value="%s" disabled selected >%s</option>', '0', 'Pilih Layanan');
            foreach ($category as $value) {
                if ($value->service == $request->service_path) {
                    $sl = 'selected';
                } else {
                    $sl = '';
                }
                printf('<option ' . $sl . ' value="%s">%s</option>', $value->service, $value->name . ' (Rp ' . number_format($value->price, 0, ',', '.') . '/K)');
            }
        } else {
            return '<option value="">Layanan tidak tersedia</option>';
        }
    }
    public function getDeskripsi(Request $request)
    {
        $smm = Smm::where('service', $request->id)->first();
        if ($smm) {
            $replace = str_replace('\r\n', '<br>', $smm->description);
            $rating = Rating::where('service_id', $smm->service)->avg('rating');
            // return response()->json([
            //     'status' => false,
            //     'message' => json_encode(compact('smm', 'replace', 'rating'))
            // ]);
            return response()->json([
                'status' => true,
                'deskripsi' => view('order.detailDeskripsi', compact('smm', 'replace', 'rating'))->render(),
                'type' => $smm->type,
                'price' => $smm->price,
                'min' => $smm->min,
                'max' => $smm->max,
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Layanan tidak ditemukan'
        ]);
    }
    public function returnInvoice()
    {
        $cookie = $_COOKIE['invoice'] ?? null;
        $deposit = Deposit::where('trxid', $cookie)->first();
        if ($deposit) {
            return redirect('deposit/invoice/' . $cookie);
        } else {
            return redirect('invoice/' . $cookie);
        }
    }
}
