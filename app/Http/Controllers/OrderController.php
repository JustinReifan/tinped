<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Smm;
use App\Models\User;
use App\Models\Config;
use App\Models\Rating;
use App\Models\Favorit;
use App\Models\History;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Referral;
use App\Models\LogBalance;
use App\Helpers\Encryption;
use App\Models\HistoryOrder;
use Illuminate\Http\Request;
use App\Models\HistoryCancel;
use App\Models\HistoryRefill;
use App\Models\ConfigReferral;
use App\Helpers\Smm as HelpersSmm;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function single(Request $request)
    {
        $id = urldecode($request->id ?? null);
        $id = str_replace(' ', '+', $id);
        $config = Config::first();
        $decrypt = Encryption::decrypt($id);
        $pairs = collect(explode(',', $config->layanan_rekomendasi))
            ->map(function ($pair) {
                return explode('||', $pair);
            });

        $provider = $pairs->firstWhere(0, $id)[1] ?? null;

        if ($id) {
            if ($decrypt) {
                $explode = explode('||', $decrypt);
                $id = $explode[0] ?? null;
                $provider = $explode[1] ?? null;
            }
            $ct = Smm::where('service', $id)
                ->where('provider', $provider)
                ->first();

            if ($ct) {
                $ct = Smm::where('category', $ct->category)->first()->id;
            } else {
                return abort(404);
            }
        } else {
            $ct = null;
        }

        $kategori = Category::where('status', 'aktif')->with('smm')->get(); // Assuming you have a relationship 'smms' in your Category model
        $favoritCategory = Favorit::distinct()
            ->where('user_id', Auth::user()->id)
            ->orderBy('category', 'asc')
            ->get(['category']);

        return view('order.single', compact('kategori', 'favoritCategory', 'id', 'ct'));
    }
    public function getLayanan(Request $request)
    {
        $id = Smm::find($request->id);
        if ($id) {
            $category = Smm::with('kategori')->where([['category', $id->category], ['status', 'aktif']])->orderBy('price', 'asc')->get();
            printf('<option value="%s" disabled selected >%s</option>', '0', 'Pilih Layanan');
            foreach ($category as $value) {
                if ($value->service == $request->service_path) {
                    $sl = 'selected';
                } else {
                    $sl = '';
                }
                $enc = Encryption::encrypt($value->service . '|' . $value->kategori->provider);
                printf('<option ' . $sl . ' value="%s">%s</option>', $enc, $value->name . ' (Rp ' . number_format($value->price, 0, ',', '.') . '/K)');
            }
        } else {
            return '<option value="">Layanan tidak tersedia</option>';
        }
    }
    public function getLayananMassal(Request $request)
    {
        $id = Smm::find($request->id);
        if ($id) {
            $category = Smm::where([['category', $id->category], ['type', 'Default']])->orWhere([['category', $id->category], ['type', 'Primary']])->orderBy('price', 'asc')->get();
            printf('<option value="%s" disabled selected >%s</option>', '0', 'Pilih Layanan');
            foreach ($category as $value) {
                $enc = Encryption::encrypt($value->service . '|' . $value->provider);
                printf('<option value="%s">%s</option>', $enc, $value->name);
            }
        } else {
            return '<option value="">Layanan tidak tersedia</option>';
        }
    }
    public function filterCategory(Request $request)
    {
        // return 'y';
        if ($request->category == 'Semua') {
            $category  = Category::orderBy('kategori', 'asc')->get();
        } else {
            $category = Category::where('kategori', 'like', '%' . $request->category . '%')->orderBy('kategori', 'asc')->get();
        }
        if ($category->first()) {
            printf('<option value="%s"  selected disabled>%s</option>', '0', 'Pilih Category');
            foreach ($category as $value) {
                $smm = Smm::where('category', $value->kategori)->first();
                $icon = Category::where('kategori', $value->kategori)->first();
                if ($icon) {
                    if ($smm) {
                        printf(
                            '<option data-icon="%s" value="%s">%s</option>',
                            htmlspecialchars('<i class="' . e($icon->icon) . '"></i>'), // Escape $icon
                            e($smm->id),                                         // Escape $value->id
                            e($value->kategori)                                           // Escape $replace
                        );
                    }
                } else {
                    printf('<option data-icon="" value="%s">%s</option>', $smm->id ?? null, $value->kategori);
                }
            }
        } else {
            return '<option value="0">Layanan tidak tersedia</option>';
        }
    }
    public function Singleproses(Request $request)
    {
        $request->validate(
            [
                'layanan' => 'required',
                'target' => 'required',
                'quantity' => 'required|numeric',
            ],
            [
                'layanan.required' => 'Layanan tidak boleh kosong',
                'target.required' => 'Target tidak boleh kosong',
                'quantity.required' => 'Jumlah Pesanan tidak boleh kosong',
                'quantity.numeric' => 'Jumlah Pesanan harus berupa angka',
            ]
        );
        $quantity = str_replace('.', '', $request->quantity);
        $decrypt = Encryption::decrypt($request->layanan == '0' ? $request->layanan2 : $request->layanan);
        $explode = explode('|', $decrypt);
        if (count($explode) == 2) {
            $service = $explode[0];
            $provider = $explode[1];
        } else {
            $service = $decrypt;
            $provider = false;
        }
        $smm = Smm::where([['service', $service], ['provider', 'like', '%' . $provider . '%'], ['status', 'aktif']])->first();
        $bot = Bot::where('user_id', Auth::user()->id)->where('type', 'whatsapp')->where('status', '1')->first();
        if (!$smm) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan');
        } else {
            if (strtolower(str_replace(' ', '_', $smm->type)) == 'custom_comments') {
                $quantity = explode("\n", $request->comments);
                $quantity = count($quantity);
            }
            $user = auth()->user();
            $total = ($smm->price / 1000) * $quantity;
            $total = ceil($total);
            if ($quantity < $smm->min) {
                return redirect()->back()->with('error', $smm->name . ' <br> Minimal order : ' . $smm->min);
            } elseif ($quantity > $smm->max) {
                return redirect()->back()->with('error', $smm->name . '<br> Maksimal order : ' . $smm->max);
            } elseif ($user->balance < $total) {
                return redirect()->back()->with('error', 'Saldo anda tidak mencukupi');
            } else {
                if ($request->target == null) {
                    return redirect()->back()->with('error', 'Link/Target tidak boleh kosong');
                } else {
                    $provider = Provider::where('nama', $smm->provider)->first();
                    if (!$provider) {
                        return redirect()->back()->with('error', 'Provider tidak ditemukan');
                    }
                    $decode = json_decode($provider->json, true);
                    $permintaan = $decode['permintaan']['order'];
                    $data = [
                        $permintaan['service'] => $smm->service,
                        $permintaan['target'] => $request->target,
                        $permintaan['quantity'] => $quantity,
                    ];
                    $data[$permintaan['provider_key']] = $decode['provider_key'];
                    if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                        $data[$permintaan['provider_id']] = $decode['provider_id'];
                    }
                    if (!$decode['provider_secret'] == '-' or !$permintaan['provider_secret'] == null) {
                        $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                    }
                    if ($permintaan['action'] != null) {
                        $data['action'] = $permintaan['action'];
                    }
                    if ($request->username) {
                        $data['usernames'] = $request->username;
                    }
                    if ($request->usernames) {
                        $data['usernames'] = $request->usernames;
                    }
                    if ($request->hashtag) {
                        $data['hashtag'] = $request->hashtag;
                    }
                    if ($request->media) {
                        $data['media'] = $request->media;
                    }
                    if ($request->answer_number) {
                        $data['answer_number'] = $request->answer_number;
                    }
                    if ($request->comments) {
                        $data[$permintaan['custom_comments']] = $request->comments;
                        $target = $request->target . '||' . $request->comments;
                    } else {
                        $target = $request->target;
                    }
                    if ($provider->proses_manual == '1') {
                        $validate = rand(100000, 999999);
                    } else {
                        $ord = new HelpersSmm($smm->provider);
                        $order = $ord->order($data);
                        $dataresponse = $decode['response']['order']['order_id'];
                        $validate = getValueByPath2($order, $dataresponse);
                    }
                    try {
                        if ($validate != false) {
                            $user = User::find(Auth::user()->id);
                            $user->balance = $user->balance - $total;
                            $user->save();
                            if ($user->referral != null) {
                                $config = ConfigReferral::where('level', auth()->user()->level)->first();
                                if ($config) {
                                    if ($config->type_komisi == 'percent') {
                                        $komisi = $total * $config->value / 100;
                                        $referral = Referral::where('code', $user->referral)->first();
                                        if ($referral) {
                                            $referral->komisi = $referral->komisi + $komisi;
                                            $referral->save();
                                        }
                                    } else {
                                        $komisi = $config->value;
                                        $referral = Referral::where('code', $user->referral)->first();
                                        if ($referral) {
                                            $referral->komisi = $referral->komisi + $komisi;
                                            $referral->save();
                                        }
                                    }
                                }
                            }
                            $datas = [
                                'user_id' => Auth::user()->id,
                                'trxid' => $validate,
                                'provider' => $smm->provider,
                                'type' => $smm->type,
                                'service_id' => $smm->service,
                                'layanan' => $smm->name,
                                'target' => $target,
                                'quantity' => $quantity,
                                'price' => $total,
                                'start_count' => 0,
                                'remains' => 0,
                                'refill' => $smm->refill == null ? 0 : $smm->refill,
                                'cancel' => $smm->cancel ?? false,
                                'status' => 'pending',
                            ];
                            History::create($datas);
                            LogBalance::create([
                                'user_id' => Auth::user()->id,
                                'kategori' => 'pesanan',
                                'jumlah' => $total,
                                'before_balance' => $user->balance + $total,
                                'after_balance' => $user->balance,
                                'description' => 'Melakukan pemesanan #' . $validate
                            ]);
                            if ($bot) {
                                if ($user->balance < $bot->value_min_saldo && $bot->switch_min_saldo == 1) {
                                    $text = 'Saldo anda kurang dari ' . number_format($bot->value_min_saldo, 0, ',', '.') . ' silahkan isi saldo anda';
                                    Senderwhatsapp('batas_saldo', $user->balance);
                                }
                                if ($total > $bot->value_max_saldo && $bot->switch_max_saldo == 1) {
                                    $text = 'Anda melakukan pemesanan dengan jumlah Rp ' . number_format($total, 0, ',', '.') . ' melebihi batas maksimal ' . number_format($bot->value_max_saldo, 0, ',', '.') . ' silahkan cek pesanan anda';
                                    $data  = [
                                        'harga_pesanan' => $total,
                                        'pesanan' => $smm->name
                                    ];
                                    Senderwhatsapp('max_pesanan', $data);
                                }
                            }
                            return redirect()->back()->with('success', 'Pesanan anda akan segera diproses, berikut detail pesanan anda <br>
                        - ID Pesanan: ' . $validate . '<br>
                        - Layanan: ' . $smm->name . '<br>
                        - Target: ' . $request->target . '<br>
                        - Jumlah: ' . number_format($quantity, 0, ',', '.') . '<br>');
                        } else {
                            return redirect()->back()->with('error', 'Gagal membuat pesanan, silahkan coba lagi');
                        }
                    } catch (\Throwable $e) {
                        return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan.. silahkan hubungi customer service melalui tiket');
                    }
                }
            }
        }
    }
    public function massal()
    {
        $kategori = Category::with(['smm' => function ($query) {
            $query->where([['type', 'like', '%default%'], ['status', 'aktif']])->orWhere([['type', 'like', '%primary%'], ['status', 'aktif']]);
        }])
            ->where('status', 'aktif')
            ->get();
        $favoritCategory = Favorit::distinct()
            ->where('user_id', Auth::user()->id)
            ->orderBy('category', 'asc')
            ->get(['category']);
        return view('order.massal', compact('kategori', 'favoritCategory'));
    }
    public function massalProses(Request $request)
    {
        $quantity = str_replace('.', '', $request->quantity);
        $decrypt = Encryption::decrypt($request->layanan == '0' ? $request->layanan2 : $request->layanan);
        $explode = explode('|', $decrypt);
        if (count($explode) == 2) {
            $service = $explode[0];
            $provider = $explode[1];
        } else {
            $service = $decrypt;
            $provider = false;
        }
        // return $service;
        $smm = Smm::where([['service', $service], ['provider', 'like', '%' . $provider . '%'], ['status', 'aktif']])->first();
        $bot = Bot::where('user_id', Auth::user()->id)->where('type', 'whatsapp')->where('status', '1')->first();
        if (!$smm) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan');
        } else {
            // return $smm;
            $user = auth()->user();
            $explode = explode("\n", $request->target);
            $jumlah = '';
            $sQuantity = false;
            foreach ($explode as $value) {
                $expl = explode('|', $value);
                if (count($expl) % 2 == 0) {
                    if ($expl[1] < $smm->min) {
                        $sQuantity = 'min';
                    } elseif ($expl[1] > $smm->max) {
                        $sQuantity = 'max';
                    } else {
                        $jumlah .= $expl[1] . ',';
                    }
                }
            }
            $explode = explode(',', $jumlah);
            $total = 0;
            $totalHarga = 0;
            foreach ($explode as $value) {
                // check integer
                if (is_numeric($value)) {
                    $total += (int)$value;
                }
            }
            $int = ((int) $smm->price / 1000) * $total;
            $int = ceil($int);
            if ($user->balance < $int) {
                return redirect()->back()->with('error', 'Saldo anda tidak mencukupi');
            } elseif ($sQuantity == 'min') {
                return redirect()->back()->with('error', $smm->name . ' <br> Minimal order : ' . $smm->min);
            } elseif ($sQuantity == 'max') {
                return redirect()->back()->with('error', $smm->name . '<br> Maksimal order : ' . $smm->max);
            } else {
                $explode = explode("\n", $request->target);
                $id = '';
                $isi = '';
                $isi2 = '';
                $status = true;
                $provider = Provider::where('nama', $smm->provider)->first();
                if (!$provider) {
                    return redirect()->back()->with('error', 'Provider tidak ditemukan');
                }
                $decode = json_decode($provider->json, true);
                $permintaan = $decode['permintaan']['order'];
                foreach ($explode as $value) {
                    $expl = explode('|', $value);
                    $jumlah = $expl[1] ?? null;
                    $jumlah = str_replace("\r", '', $jumlah);
                    $jumlah = str_replace("\n", '', $jumlah);
                    $target = $expl[0];
                    $data = [
                        $permintaan['service'] => $smm->service,
                        $permintaan['target'] => $target,
                        $permintaan['quantity'] => $jumlah,
                    ];
                    $data[$permintaan['provider_key']] = $decode['provider_key'];
                    if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                        $data[$permintaan['provider_id']] = $decode['provider_id'];
                    }
                    if (!$decode['provider_secret'] == '-' or !$permintaan['provider_secret'] == null) {
                        $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                    }
                    if ($permintaan['action'] != null) {
                        $data['action'] = $permintaan['action'];
                    }
                    $total = ($smm->price / 1000) * $jumlah;
                    $user = User::find(auth()->user()->id);
                    $user->balance = $user->balance - $total;
                    $user->omzet = $user->omzet + $total;
                    $user->save();
                    if ($user->referral != null) {
                        $config = ConfigReferral::where('level', auth()->user()->level)->first();
                        if ($config) {
                            if ($config->type_komisi == 'percent') {
                                $komisi = $total * $config->value / 100;
                                $referral = Referral::where('code', $user->referral)->first();
                                if ($referral) {
                                    $referral->komisi = $referral->komisi + $komisi;
                                    $referral->save();
                                }
                            } else {
                                $komisi = $config->value;
                                $referral = Referral::where('code', $user->referral)->first();
                                if ($referral) {
                                    $referral->komisi = $referral->komisi + $komisi;
                                    $referral->save();
                                }
                            }
                        }
                    }
                    if ($provider->proses_manual == '1') {
                        $validate =  rand(100000, 999999);
                    } else {
                        $order = new HelpersSmm($smm->provider);
                        $order = $order->order($data);
                        $dataresponse = $decode['response']['order']['order_id'];
                        $validate =  getValueByPath2($order, $dataresponse);
                    }
                    $totalHarga += $total;
                    $data = [
                        'user_id' => Auth::user()->id,
                        'trxid' =>  $validate,
                        'provider' => $smm->provider,
                        'type' => $smm->type,
                        'layanan' => $smm->name,
                        'target' => $target,
                        'quantity' => $jumlah,
                        'price' => $total,
                        'refill' => $smm->refill,
                        'cancel' => $smm->cancel,
                        'start_count' => 0,
                        'remains' => 0,
                        'status' => 'pending',
                    ];
                    if ($validate != false) {
                        LogBalance::create([
                            'user_id' => Auth::user()->id,
                            'type' => 'order',
                            'kategori' => 'pesanan',
                            'jumlah' => $total,
                            'before_balance' => $user->balance + $total,
                            'after_balance' => $user->balance,
                            'description' => 'Melakukan pemesanan #' . $validate
                        ]);
                        History::create($data);
                        $isi .= '<li>ID Pesanan : ' . $validate . ', Target: ' . $target . ' dengan jumlah pesanan: ' . $jumlah . '</li>';
                        $isi2 .= 'ID Pesanan : ' . $validate . ', Target: ' . $target . ' dengan jumlah pesanan: ' . $jumlah . '<br>';
                    } else {
                        $status = false;
                        $isi .= '<li class="text-danger">Gagal Membuat Transaksi Target: ' . $target . ' dengan jumlah pesanan: ' . $jumlah . '</li>';
                        $isi2 .= 'Gagal Membuat Transaksi Target: ' . $target . ' dengan jumlah pesanan: ' . $jumlah . '<br>';
                    }
                }
                if ($bot) {
                    if ($user->balance < $bot->value_min_saldo && $bot->switch_min_saldo == 1) {
                        Senderwhatsapp('batas_saldo', $user->balance);
                    }
                    if ($total > $bot->value_max_saldo && $bot->switch_max_saldo == 1) {
                        $data = [
                            'harga_pesanan' => $total,
                            'pesanan' => $isi2,
                        ];
                        Senderwhatsapp('max_saldo', $total);
                    }
                }
                return redirect()->back()->with('success', 'Pesanan berhasil dibuat <br>
                - Layanan : ' . $smm->name . '<br>
                - Detail : ' . $isi . '');
            }
        }
    }
    public function riwayat(Request $request)
    {
        return view('order.history');
    }
    public function historyDetail(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $history = History::where('trxid', $request->id)->first();
        } else {
            $history = History::where([['trxid', $request->id], ['user_id', Auth::user()->id]])->first();
        }
        if ($history) {
            // return '<h1>' . $history . '</h1>';
            return view('order.history-detail', compact('history'));
        } else {
            return '<div class="alert alert-danger">Data tidak ditemukan</div>';
        }
    }
    public function updatePesanan(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $history = History::where('id', $request->id)->first();
            if ($history) {
                $type = $request->type;
                $value = $request->value;
                $history->$type = $value;
                $history->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil mengubah status pesanan',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }
    public function historyDetailOrder(Request $request)
    {

        $history = HistoryOrder::with('payment')->where('trxid', $request->id)->first();
        if ($history) {
            return view('order.history-detail-order', compact('history'));
        } else {
            return '<div class="alert alert-danger">Data tidak ditemukan</div>';
        }
    }
    public function refill(Request $request)
    {
        $history = History::where('trxid', $request->id)->first();
        if (!$history) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        } else {
            if ($history->user_id != auth()->user()->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
            $provider = Provider::where('nama', $history->provider)->first();
            if (!$provider) {
                return response()->json([
                    'status' => false,
                    'message' => 'Provider tidak ditemukan',
                ]);
            }
            if ($history->status == 'pending') {
                return response()->json([
                    'status' => false,
                    'message' => 'Pesanan belum selesai',
                ]);
            }
            $decode = json_decode($provider->json, true);
            $data = [
                $decode['permintaan']['refill']['provider_key'] => $decode['provider_key'],
                $decode['permintaan']['refill']['order_id'] => $request->id,
            ];
            if ($decode['permintaan']['refill']['provider_id']) {
                $data[$decode['permintaan']['refill']['provider_id']] = $decode['provider_id'];
            }
            if ($decode['permintaan']['refill']['provider_secret']) {
                $data[$decode['permintaan']['refill']['provider_secret']] = $decode['provider_secret'];
            }
            if ($decode['permintaan']['refill']['action'] != null) {
                $data['action'] = $decode['permintaan']['refill']['action'];
            }
            try {
                if ($provider->proses_manual == '1') {
                    $validate = $history->trxid;
                    $cek = HistoryRefill::where('refill_id', $validate)->first();
                    if ($cek) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Pesanan sudah direfill',
                        ]);
                    }
                } else {
                    $smm = new HelpersSmm($history->provider);
                    $refill = $smm->refill($data);
                    $dataresponse = $decode['response']['refill']['refill_id'];
                    $validate = getValueByPath2($refill, $dataresponse);
                }
                if ($validate) {
                    HistoryRefill::create([
                        'user_id' => auth()->user()->id,
                        'refill_id' => $validate,
                        'provider' => $history->provider,
                        'layanan' => $history->layanan,
                        'target' => $history->target,
                        'status' => 'pending',
                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'Pesanan berhasil direfill',
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gagal refill pesanan',
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal refill pesanan',
                ]);
            }
        }
    }
    public function cancel(Request $request)
    {
        $history = History::where('trxid', $request->id)->first();
        if (!$history) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        } else {
            if ($history->user_id != auth()->user()->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
            $provider = Provider::where('nama', $history->provider)->first();
            if (!$provider) {
                return response()->json([
                    'status' => false,
                    'message' => 'Provider tidak ditemukan',
                ]);
            }
            if (!$history->status == 'process' || !$history->status == 'pending') {
                return response()->json([
                    'status' => false,
                    'message' => 'Pesanan sudah selesai',
                ]);
            }
            $decode = json_decode($provider->json, true);
            $data = [
                $decode['permintaan']['cancel']['provider_key'] => $decode['provider_key'],
                $decode['permintaan']['cancel']['order_id'] => $request->id,
            ];
            if ($decode['permintaan']['cancel']['provider_id']) {
                $data[$decode['permintaan']['cancel']['provider_id']] = $decode['provider_id'];
            }
            if ($decode['permintaan']['cancel']['provider_secret']) {
                $data[$decode['permintaan']['cancel']['provider_secret']] = $decode['provider_secret'];
            }
            if ($decode['permintaan']['cancel']['action'] != null) {
                $data['action'] = $decode['permintaan']['cancel']['action'];
            }
            try {
                if ($history->req_cancel) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Request sudah terkirim',
                    ]);
                }


                $smm = new HelpersSmm($history->provider);
                $cancel = $smm->cancel($data)[0];
                // return response()->json([
                //     'status' => true,
                //     'message' => json_encode($cancel),
                // ]);
                $dataresponse = $decode['response']['cancel']['status'];
                $validate = getValueByPath2($cancel, $dataresponse);

                if ($validate) {
                    $history->update(['req_cancel' => $validate]);
                    return response()->json([
                        'status' => true,
                        'message' => 'Request cancel pesanan berhasil!',
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gagal! Result kosong',
                    ]);
                }
            } catch (\Exception $e) {

                return response()->json([
                    'status' => false,
                    'message' => 'Gagal melakukan request API',
                ]);
            }
        }
    }
    public function riwayatRefill()
    {
        return view('order.riwayat-refill');
    }
    public function listLayanan()
    {
        return view('order.list-layanan');
    }
    public function detailService(Request $request)
    {
        $smm = Smm::where('service', $request->id)->first();
        if (!$smm) {
            return '<div class="alert alert-danger">Layanan tidak ditemukan</div>';
        } else {
            return view('order.detail-layanan', compact('smm'));
        }
    }
    public function ratingService(Request $request)
    {
        $smm = Smm::where('service', $request->id)->first();
        if (!$smm) {
            return '<div class="alert alert-danger">Layanan tidak ditemukan</div>';
        } else {
            $cekRating = Rating::where([['user_id', Auth::user()->id], ['service_id', $smm->service]])->first();
            $ratings = Rating::where('service_id', $smm->service)->limit(10)->get();
            $count = Rating::where('service_id', $smm->service)->count();
            return view('order.rating', compact('smm', 'cekRating', 'ratings', 'count'));
        }
    }
    public function submitRatings(Request $request)
    {
        $smm = Smm::where('service', $request->service)->first();
        if (!$smm) {
            return response()->json([
                'status' => false,
                'text' => 'Layanan tidak ditemukan',
            ]);
        } else {
            $cek = History::where('layanan', $smm->name)->where('user_id', auth()->user()->id)->first();
            if (!$cek) {
                return response()->json([
                    'status' => false,
                    'text' => 'Anda belum pernah membeli layanan ini',
                ]);
            } else {
                Rating::create([
                    'user_id' => auth()->user()->id,
                    'service_id' => $smm->service,
                    'rating' => $request->star,
                ]);
                return response()->json([
                    'status' => true,
                    'text' => 'Terima kasih atas penilaian anda',
                ]);
            }
        }
    }
    public function favoritService(Request $request)
    {
        $service = Smm::where('service', $request->id)->first();
        if ($service) {
            $favorit = Favorit::where('user_id', Auth::user()->id)->where([['service_id', $request->id], ['category', $service->category], ['layanan', $service->name], ['price', $service->price]])->first();
            if ($favorit) {
                return response()->json([
                    'status' => false,
                    'message' => 'Layanan sudah ada di favorit'
                ]);
            } else {
                Favorit::create([
                    'user_id' => Auth::user()->id,
                    'service_id' => $service->service,
                    'category' => $service->category,
                    'layanan' => $service->name,
                    'price' => $service->price,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Layanan berhasil ditambahkan ke favorit'
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }
    }
    public function unfavService(Request $request)
    {
        $favorit = Favorit::where([['service_id', $request->id]])->first();
        if ($favorit) {
            $favorit->delete();
            return response()->json([
                'status' => true,
                'message' => 'Layanan berhasil dihapus dari favorit'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }
    }
    public function getLayananFavorite(Request $request)
    {
        $category = Favorit::where([['category', $request->id], ['user_id', Auth::user()->id]])->get();
        if ($category->first()) {
            printf('<option value="%s" disabled selected>%s</option>', '0', 'Pilih Layanan');
            foreach ($category as $row) {
                $Smm = Smm::where([['service', $row->service_id], ['name', $row->layanan]])->first();
                if ($Smm) {
                    $encrypt = Encryption::encrypt($Smm->service . '|' . $Smm->provider);
                    printf('<option value="%s">%s</option>', $encrypt, $row->layanan);
                }
            }
        }
    }
    public function getLayananSearchId(Request $request)
    {
        $smm = Smm::where([['service', $request->id], ['status', 'aktif']])->get();
        if ($smm) {
            $replace = str_replace("\r\n", '<br>', $smm->first()->description);
            $replace = str_replace("\n", '<br>', $replace);
            $rating = Rating::where('service_id', $smm->first()->service)->avg('rating');
            return response()->json([
                'status' => true,
                'html' => view('order.search_id', compact('smm'))->render(),
                'deskripsi' => view('order.detailDeskripsi', compact('smm', 'replace', 'rating'))->render(),
                'type' => strtolower(str_replace(' ', '_', $smm->first()->type)),
                'price' => $smm->first()->price,
                'min' => $smm->first()->min,
                'max' => $smm->first()->max,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Layanan tidak ditemukan'
            ]);
        }
    }
    public function getDeskripsi(Request $request)
    {
        $decrypt = Encryption::decrypt($request->id);
        $explode = explode('|', $decrypt);
        if (count($explode) < 2) {
            return response()->json([
                'status' => false,
                'message' => 'Layanan tidak ditemukan'
            ]);
        }
        $service = $explode[0];
        $provider = $explode[1];
        $smm = Smm::where([['service', $service], ['provider', $provider]])->first();
        if ($smm) {
            $replace = str_replace("\r\n", '<br>', $smm->description);
            $replace = str_replace("\n", '<br>', $replace);
            $rating = Rating::where('service_id', $smm->service)->avg('rating');
            return response()->json([
                'status' => true,
                'deskripsi' => view('order.detailDeskripsi2', compact('smm', 'replace', 'rating'))->render(),
                'type' => strtolower(str_replace(' ', '_', $smm->type)),
                'price' => $smm->price,
                'min' => $smm->min,
                'max' => $smm->max,
                'refill' => $smm->refill,
                'cancel' => $smm->cancel
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Layanan tidak ditemukan'
        ]);
    }
    public function LayananFavorit()
    {
        return view('order.layanan-favorit');
    }
    public function favoritDelete(Request $request)
    {
        $service = Favorit::where([['id', $request->id], ['user_id', Auth::user()->id]])->first();
        if ($service) {
            $service->delete();
            return response()->json([
                'status' => true,
                'service' => $service->service,
                'message' => 'Layanan berhasil dihapus dari favorit'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }
    }
}
