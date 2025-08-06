<?php

namespace App\Http\Controllers;

use App\Helpers\Encryption;
use App\Helpers\Smm as HelpersSmm;
use App\Models\Bot;
use App\Models\ConfigReferral;
use App\Models\Favorit;
use App\Models\History;
use App\Models\HistoryRefill;
use App\Models\LogBalance;
use App\Models\Provider;
use App\Models\Referral;
use App\Models\Smm;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function profile(Request $request)
    {
        $api = Encryption::encrypt($request->api_key);
        if (isset($request->api_id) && isset($api)) {
            $user = User::where([['api_id', $request->api_id], ['api_key', $api]])->first();

            if ($user) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = '';
                if ($user->whitelist_ip == $request->ip()) {
                    $status = '2';
                } else if (preg_match("/,/i", $user->whitelist_ip)) {
                    $explode = explode(",", $user->whitelist_ip);
                    $count = count($explode);
                    foreach (range(0, $count - 1) as $num) {
                        if ($explode[$num] == $ip) {
                            $status = '1';
                        } else {
                            $status = '3';
                        }
                    }
                } else {
                    $status = '3';
                }
                if ($status == '3') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized IP (' . $request->ip()
                            .
                            ')',
                    ], 403);
                } else {
                    return response()->json([
                        'status' => true,
                        'data' => [
                            "full_name" => $user->name,
                            "username" => $user->username,
                            'email' => $user->email,
                            "balance" => $user->balance
                        ]
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'User Not Found',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Api ID & Api harus di isi!'
            ], 403);
        }
    }
    public function services(Request $request)
    {
        $api = Encryption::encrypt($request->api_key);
        if (isset($request->api_id) && isset($api)) {
            $user = User::where([['api_id', $request->api_id], ['api_key', $api]])->first();
            if ($user) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = '';
                if ($user->whitelist_ip == $request->ip()) {
                    $status = '2';
                } else if (preg_match("/,/i", $user->whitelist_ip)) {
                    $explode = explode(",", $user->whitelist_ip);
                    $count = count($explode);
                    foreach (range(0, $count - 1) as $num) {
                        if ($explode[$num] == $ip) {
                            $status = '1';
                        } else {
                            $status = '3';
                        }
                    }
                } else {
                    $status = '3';
                }
                if ($status == '3') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized IP (' . $request->ip()
                            .
                            ')',
                    ], 403);
                } else {
                    if ($request->service_fav == true) {
                        $fav = Favorit::all();
                        $enc = [];
                        foreach ($fav as $filter) {
                            $smm = Smm::where([['service', $filter->service_id], ['category', $filter->category]])->get();
                            if (!$smm->first()) {
                                $fav = Favorit::find($filter->id);
                                $fav->delete();
                            } else {
                                foreach ($smm as $data) {
                                    $filteredData = $data->toArray();
                                    unset($filteredData['provider']);
                                    unset($filteredData['id']);
                                    unset($filteredData['created_at']);
                                    unset($filteredData['updated_at']);
                                    unset($filteredData['status']);
                                    $enc[] = $filteredData;
                                }
                            }
                        }
                        return response()->json([
                            'status' => true,
                            'data' => $enc,
                        ], 200);
                    } else {
                        $smm = Smm::all();
                        $encs = [];
                        foreach ($smm as $data) {
                            $filteredData = $data->toArray();
                            unset($filteredData['provider']);
                            unset($filteredData['id']);
                            unset($filteredData['created_at']);
                            unset($filteredData['updated_at']);
                            unset($filteredData['status']);
                            $encs[] = $filteredData;
                        }
                        return response()->json([
                            'status' => true,
                            'data' => $encs,
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'User Not Found',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Api ID & Api harus di isi!'
            ], 403);
        }
    }
    public function order(Request $request)
    {
        $api = Encryption::encrypt($request->api_key);
        if (isset($request->api_id) && isset($api)) {
            $user = User::where([['api_id', $request->api_id], ['api_key', $api]])->first();
            if ($user) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = '';
                if ($user->whitelist_ip == $request->ip()) {
                    $status = '2'; // IP cocok langsung dengan whitelist
                } else if (preg_match("/,/i", $user->whitelist_ip)) {
                    $explode = explode(",", $user->whitelist_ip);
                    $count = count($explode);
                    $status = '3'; // Default ke unauthorized, kecuali ada yang cocok

                    foreach (range(0, $count - 1) as $num) {
                        if (trim($explode[$num]) == $request->ip()) { // Trim whitespace
                            $status = '1'; // IP ditemukan dalam daftar whitelist
                            break; // Hentikan loop jika sudah ditemukan
                        }
                    }
                } else {
                    $status = '3'; // Tidak ada koma, dan tidak cocok langsung
                }

                if ($status == '3') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized IP (' . $request->ip() . ')',
                    ], 403);
                } else {
                    $service = Smm::where('service', $request->service)->first();
                    if ($service) {
                        if ($request->quantity < $service->min) {
                            return response()->json([
                                'status' => false,
                                'data' => 'Minimal pesanan adalah ' . $service->min,
                            ], 404);
                        } elseif ($request->quantity > $service->max) {
                            return response()->json([
                                'status' => false,
                                'data' => 'Maksimal pesanan adalah ' . $service->max,
                            ], 404);
                        } else {
                            $total = ($service->price / 1000) * $request->quantity;
                            $total = ceil($total);
                            if ($user->balance < $total) {
                                return response()->json([
                                    'status' => false,
                                    'data' => 'Saldo anda tidak cukup',
                                ], 404);
                            } else {
                                $provider = Provider::where('nama', $service->provider)->first();
                                if (!$provider) {
                                    return response()->json([
                                        'status' => false,
                                        'data' => 'Maaf, transaksi tidak dapat diproses. Silahkan hubungi admin',
                                    ], 404);
                                }
                                $decode = json_decode($provider->json, true);
                                $permintaan = $decode['permintaan']['order'];
                                $data = [
                                    $permintaan['service'] => $service->service,
                                    $permintaan['target'] => $request->target,
                                    $permintaan['quantity'] => $request->quantity,
                                    $permintaan['custom_comments'] => $request->comments,
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
                                if ($provider->proses_manual == '1') {
                                    $validate = rand(100000, 999999);
                                } else {
                                    $ord = new HelpersSmm($service->provider);
                                    $order = $ord->order($data);
                                    $dataresponse = $decode['response']['order']['order_id'];
                                    $validate = getValueByPath2($order, $dataresponse);
                                }
                                if ($validate != false) {
                                    $user->balance = $user->balance - $total;
                                    $user->save();
                                    $datas = [
                                        'user_id' => $user->id,
                                        'trxid' => $validate,
                                        'provider' => $service->provider,
                                        'type' => $service->type,
                                        'service_id' => $service->service,
                                        'layanan' => $service->name,
                                        'target' => $request->target,
                                        'quantity' => $request->quantity,
                                        'price' => $total,
                                        'start_count' => 0,
                                        'remains' => 0,
                                        'refill' => $service->refill,
                                        'status' => 'pending',
                                    ];
                                    History::create($datas);
                                    LogBalance::create([
                                        'user_id' => $user->id,
                                        'type' => 'order',
                                        'kategori' => 'pesanan',
                                        'jumlah' => $total,
                                        'before_balance' => $user->balance + $total,
                                        'after_balance' => $user->balance,
                                        'description' => 'Melakukan pemesanan #' . $validate
                                    ]);
                                    $bot = Bot::where('user_id', $user->id)->where('type', 'whatsapp')->where('status', '1')->first();
                                    if ($bot) {
                                        try {
                                            if ($user->balance < $bot->value_min_saldo && $bot->switch_min_saldo == 1) {
                                                $text = 'Saldo anda kurang dari ' . number_format($bot->value_min_saldo, 0, ',', '.') . ' silahkan isi saldo anda';
                                                Senderwhatsapp('batas_saldo', $user->balance);
                                            }
                                            if ($total > $bot->value_max_saldo && $bot->switch_max_saldo == 1) {
                                                $text = 'Anda melakukan pemesanan dengan jumlah ' . number_format($total, 0, ',', '.') . ' melebihi batas maksimal ' . number_format($bot->value_max_saldo, 0, ',', '.') . ' silahkan cek pesanan anda';
                                                Senderwhatsapp('max_saldo', $total);
                                            }
                                        } catch (\Exception $e) {
                                        }
                                    }
                                    if ($user->referral != null) {
                                        $config = ConfigReferral::where('level', $user->level)->first();
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
                                    return response()->json([
                                        'status' => true,
                                        'data' => [
                                            'id' => $validate,
                                            'price' => $total,
                                        ],
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => false,
                                        'data' => 'Maaf, transaksi tidak dapat diproses. Silahkan hubungi admin',
                                    ], 404);
                                }
                            }
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'data' => 'Service Not Found',
                        ], 404);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'User Not Found',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Api key atau api id harus di isi!',
            ], 403);
        }
    }
    public function status(Request $request)
    {
        $api = Encryption::encrypt($request->api_key);
        if (isset($request->api_id) && isset($api)) {
            $user = User::where([['api_id', $request->api_id], ['api_key', $api]])->first();
            if ($user) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = '';
                if ($user->whitelist_ip == $request->ip()) {
                    $status = '2';
                } else if (preg_match("/,/i", $user->whitelist_ip)) {
                    $explode = explode(",", $user->whitelist_ip);
                    $count = count($explode);
                    foreach (range(0, $count - 1) as $num) {
                        if ($explode[$num] == $ip) {
                            $status = '1';
                        } else {
                            $status = '3';
                        }
                    }
                } else {
                    $status = '3';
                }
                if ($status == '3') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized IP (' . $request->ip()
                            .
                            ')',
                    ], 403);
                } else {
                    $history = History::where('trxid', $request->id)->first();
                    if ($history) {
                        $provider = Provider::where('nama', $history->provider)->first();
                        if ($provider) {
                            $decode = json_decode($provider->json, true);
                            $permintaan = $decode['permintaan']['status'];
                            $history->trxid = (string) $history->trxid;
                            $data = [
                                $permintaan['order_id'] => $history->trxid,
                            ];
                            $data[$permintaan['provider_key']] = $decode['provider_key'];
                            if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                                $data[$permintaan['provider_id']] = $decode['provider_id'];
                            }
                            if (!$decode['provider_secret'] == '-' && !$permintaan['provider_secret'] == null && !$decode['provider_secret'] == null) {
                                $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                            }
                            if ($permintaan['action'] != null) {
                                $data['action'] = $permintaan['action'];
                            }
                            if ($provider->proses_manual == '1') {
                                return response()->json([
                                    'status' => true,
                                    'data' => [
                                        'id' => $history->trxid,
                                        'status' => ucfirst($history->status),
                                        'start_count' => $history->start_count,
                                        'remains' => $history->remains,
                                    ]
                                ]);
                            } else {
                                $smm = new HelpersSmm($history->provider);
                                $smm = $smm->status($data);
                                $status = strtolower(getValueByPath2($smm, $decode['response']['status']['status']));
                                if ($status) {
                                    $start_count = getValueByPath2($smm, $decode['response']['status']['start_count']);
                                    $remains = getValueByPath2($smm, $decode['response']['status']['remains']);
                                    if ($status == strtolower($decode['status_value']['status']['pending'])) {
                                        $status = 'pending';
                                    } elseif ($status == strtolower($decode['status_value']['status']['processing']) or $status == 'in progress') {
                                        $status = 'process';
                                    } elseif ($status == strtolower($decode['status_value']['status']['success'])) {
                                        $status = 'done';
                                    } elseif ($status == strtolower($decode['status_value']['status']['partial'])) {
                                        if ($user) {
                                            LogBalance::create([
                                                'user_id' => $history->user_id,
                                                'kategori' => 'refund',
                                                'jumlah' => $history->price,
                                                'before_balance' => $user->balance,
                                                'after_balance' => $user->balance + $history->price,
                                                'description' => 'Refund Order #' . $history->trxid . ' dengan jumlah Rp ' . $this->format($history->price),
                                            ]);
                                            $user->balance = $user->balance + $history->price;
                                            $user->save();
                                        }
                                        $status = 'partial';
                                    } elseif ($status == strtolower($decode['status_value']['status']['error'])) {
                                        if ($user) {
                                            LogBalance::create([
                                                'user_id' => $history->user_id,
                                                'kategori' => 'refund',
                                                'jumlah' => $history->price,
                                                'before_balance' => $user->balance,
                                                'after_balance' => $user->balance + $history->price,
                                                'description' => 'Refund Order #' . $history->trxid . ' dengan jumlah Rp ' . $this->format($history->price),
                                            ]);
                                            $user->balance = $user->balance + $history->price;
                                            $user->save();
                                        }
                                        $status = 'error';
                                    } else {
                                        if ($user) {
                                            LogBalance::create([
                                                'user_id' => $history->user_id,
                                                'kategori' => 'refund',
                                                'jumlah' => $history->price,
                                                'before_balance' => $user->balance,
                                                'after_balance' => $user->balance + $history->price,
                                                'description' => 'Refund Order #' . $history->trxid . ' dengan jumlah Rp ' . $this->format($history->price),
                                            ]);
                                            $user->balance = $user->balance + $history->price;
                                            $user->save();
                                        }
                                        $status = 'refund';
                                    }
                                    $history->update([
                                        'status' => $status,
                                        'start_count' => $start_count,
                                        'remains' => $remains,
                                    ]);
                                    return response()->json([
                                        'status' => true,
                                        'data' => [
                                            'id' => $history->trxid,
                                            'status' => ucfirst($status),
                                            'start_count' => $start_count,
                                            'remains' => $remains,
                                        ]
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => true,
                                        'data' => [
                                            'id' => $history->trxid,
                                            'status' => ucfirst($status),
                                            'start_count' => $history->start_count,
                                            'remains' => $history->remains,
                                        ]
                                    ]);
                                }
                            }
                        } else {
                            return response()->json([
                                'status' => false,
                                'data' => 'Maaf, transaksi tidak dapat diproses. Silahkan hubungi admin',
                            ], 404);
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'data' => 'History atau transaksi tidak ditemukan',
                        ], 404);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'User Not Found',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Api ID & Api harus di isi!'
            ], 403);
        }
    }
    public function refill(Request $request)
    {
        $api = Encryption::encrypt($request->api_key);
        if (isset($request->api_id) && isset($api)) {
            $user = User::where([['api_id', $request->api_id], ['api_key', $api]])->first();
            if ($user) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = '';
                if ($user->whitelist_ip == $request->ip()) {
                    $status = '2';
                } else if (preg_match("/,/i", $user->whitelist_ip)) {
                    $explode = explode(",", $user->whitelist_ip);
                    $count = count($explode);
                    foreach (range(0, $count - 1) as $num) {
                        if ($explode[$num] == $ip) {
                            $status = '1';
                        } else {
                            $status = '3';
                        }
                    }
                } else {
                    $status = '3';
                }
                if ($status == '3') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized IP (' . $request->ip()
                            .
                            ')',
                    ], 403);
                } else {
                    $history = History::where('trxid', $request->id_order)->first();
                    if ($history) {
                        if ($history->status == 'pending') {
                            return response()->json([
                                'status' => false,
                                'message' => 'Pesanan belum selesai',
                            ]);
                        }
                        $provider = Provider::where('nama', $history->provider)->first();
                        if (!$provider) {
                            return response()->json([
                                'status' => false,
                                'data' => 'Maaf, transaksi tidak dapat diproses. Silahkan hubungi admin',
                            ], 404);
                        } else {
                            $decode = json_decode($provider->json, true);
                            $data = [
                                $decode['permintaan']['refill']['provider_key'] => $decode['provider_key'],
                                $decode['permintaan']['refill']['order_id'] => $request->id_order,
                            ];
                            if ($decode['permintaan']['refill']['provider_id']) {
                                $data[$decode['permintaan']['refill']['provider_id']] = $decode['provider_id'];
                            }
                            if ($decode['permintaan']['refill']['provider_secret']) {
                                $data[$decode['permintaan']['refill']['provider_secret']] = $decode['provider_secret'];
                            }
                            if ($provider->proses_manual == '1') {
                                $rand = rand(100000, 999999);
                                HistoryRefill::create([
                                    'user_id' => $user->id,
                                    'refill_id' => rand(100000, 999999),
                                    'provider' => $history->provider,
                                    'layanan' => $history->service,
                                    'target' => $history->target,
                                    'status' => 'pending',
                                ]);
                                return response()->json([
                                    'status' => true,
                                    'data' => [
                                        'id_refill' => $rand,
                                    ],
                                ]);
                            } else {
                                $smm = new HelpersSmm($history->provider);
                                $refill = $smm->refill($data);
                                $dataresponse = $decode['response']['refill']['refill_id'];
                                $validate = getValueByPath2($refill, $dataresponse);
                                if ($validate) {
                                    if ($validate) {
                                        HistoryRefill::create([
                                            'user_id' => $user->id,
                                            'refill_id' => $refill->data->id,
                                            'provider' => $history->provider,
                                            'layanan' => $history->service,
                                            'target' => $history->target,
                                            'status' => 'pending',
                                        ]);
                                        return response()->json([
                                            'status' => true,
                                            'data' => [
                                                'id_refill' => $validate,
                                            ],
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => false,
                                            'message' => 'Gagal refill pesanan',
                                        ]);
                                    }
                                } else {
                                    return response()->json([
                                        'status' => false,
                                        'message' => 'Gagal refill pesanan',
                                    ]);
                                }
                            }
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'data' => 'History atau transaksi tidak ditemukan',
                        ], 404);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'User Not Found',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Api ID & Api harus di isi!'
            ], 403);
        }
    }
    public function refill_status(Request $request)
    {
        $api = Encryption::encrypt($request->api_key);
        if (isset($request->api_id) && isset($api)) {
            $user = User::where([['api_id', $request->api_id], ['api_key', $api]])->first();
            if ($user) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = '';
                if ($user->whitelist_ip == $request->ip()) {
                    $status = '2';
                } else if (preg_match("/,/i", $user->whitelist_ip)) {
                    $explode = explode(",", $user->whitelist_ip);
                    $count = count($explode);
                    foreach (range(0, $count - 1) as $num) {
                        if ($explode[$num] == $ip) {
                            $status = '1';
                        } else {
                            $status = '3';
                        }
                    }
                } else {
                    $status = '3';
                }
                if ($status == '3') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized IP (' . $request->ip()
                            .
                            ')',
                    ], 403);
                } else {
                    $history = HistoryRefill::where('trxid', $request->id_refill)->first();
                    if ($history) {
                        $provider = Provider::where('nama', $history->provider)->first();
                        if ($provider) {
                            $decode = json_decode($provider->json, true);
                            $permintaan = $decode['permintaan']['refill_status'];
                            $history->refill_id = (string) $history->refill_id;
                            $data = [
                                $permintaan['refill_id'] => $history->refill_id,
                            ];
                            $data[$permintaan['provider_key']] = $decode['provider_key'];
                            if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                                $data[$permintaan['provider_id']] = $decode['provider_id'];
                            }
                            if (!$decode['provider_secret'] == '-' && !$permintaan['provider_secret'] == null && !$decode['provider_secret'] == null) {
                                $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                            }
                            if ($permintaan['action'] != null) {
                                $data['action'] = $permintaan['action'];
                            }
                            if ($provider->proses_manual == '1') {
                                return response()->json([
                                    'status' => true,
                                    'data' => [
                                        'status' => ucfirst($history->status),
                                        'id_refill' => $history->refill_id,
                                    ]
                                ]);
                            } else {
                                $smm = new HelpersSmm($history->provider);
                                $smm = $smm->refill_status($data);
                                $status = getValueByPath2($smm, $decode['response']['refill_status']['status']);
                                if ($status) {
                                    if ($status == $decode['status_value']['refill_status']['pending']) {
                                        $status = 'pending';
                                    } elseif ($status == $decode['status_value']['refill_status']['processing']) {
                                        $status = 'process';
                                    } elseif ($status == $decode['status_value']['refill_status']['success']) {
                                        $status = 'done';
                                    } elseif ($status == $decode['status_value']['refill_status']['partial']) {
                                        $status = 'partial';
                                    } elseif ($status == $decode['status_value']['refill_status']['cancel']) {
                                        $status = 'cancel';
                                    } elseif ($status == $decode['status_value']['refill_status']['error']) {
                                        $status = 'error';
                                    } else {
                                        $status = 'refund';
                                    }
                                    $history->update([
                                        'status' => $status,
                                    ]);
                                    return response()->json([
                                        'status' => true,
                                        'data' => [
                                            'status' => ucfirst($status),
                                            'id_refill' => $history->refill_id,
                                        ]
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => false,
                                        'message' => 'Gagal refill pesanan',
                                    ]);
                                }
                            }
                        } else {
                            return response()->json([
                                'status' => false,
                                'data' => 'Maaf, transaksi tidak dapat diproses. Silahkan hubungi admin',
                            ], 404);
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'data' => 'History atau transaksi tidak ditemukan',
                        ], 404);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'User Not Found',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Api ID & Api harus di isi!'
            ], 403);
        }
    }
    function format($num)
    {
        return number_format($num, 0, ",", ".");
    }
}
