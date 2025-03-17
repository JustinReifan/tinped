<?php

use App\Helpers\Encryption;
use App\Helpers\Smm as HelpersSmm;
use App\Http\Controllers\ApiController;
use App\Libraries\PclZip;
use App\Mail\Verify;
use App\Models\Bot;
use App\Models\BotConfig;
use App\Models\Config;
use App\Models\Deposit;
use App\Models\History;
use App\Models\HistoryOrder;
use App\Models\IconLayanan;
use App\Models\LogBalance;
use App\Models\Provider;
use App\Models\Smm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use iPaymu\iPaymu;

Route::get('migrasi', function () {
    $user = DB::table('user')->get();
    $config = Config::first();
    foreach ($user as $row) {
        User::create([
            'username' => $row->username,
            'email' => $row->email,
            'password' => $row->password,
            'name' => $row->full_name,
            'whatsapp' => $row->phone_number,
            'balance' => $row->balance,
            'omzet' => 0,
            'level' => 'basic',
            'role' => $row->level == 'Admin' ? 'admin' : 'user',
            'api_key' => $row->api_key,
            'api_id' => rand(1000, 9999),
            'whitelist_ip' => $row->api_whitelist_ip,
            'is_mail' => '1',
            'gender' => 'male',
            'zona' => 'Asia/Jakarta',
            'image' => $config->default_image,
            'status' => $row->status == '1' ? 'active' : 'banned',
        ]);
    }
    $order = DB::table('orders')->get();
    if ($order->first()) {
        foreach ($order as $row) {
            $decode = json_decode($row->provider_status_log, true);
            // dd($decode['data']['status']);
            if (isset($decode['status'])) {
                if (isset($decode['data']['status'])) {
                    $status = $decode['data']['status'];
                    if ($status == 'Pending') {
                        $status = 'pending';
                    } elseif ($status == 'Processing' or $status == 'In Progress') {
                        $status = 'process';
                    } elseif ($status == 'Success' or $status == 'Completed') {
                        $status = 'done';
                    } elseif ($status == 'Partial') {
                        $status = 'partial';
                    } elseif ($status == 'Error') {
                        $status = 'error';
                    } else {
                        $status = 'refund';
                    }
                } else {
                    $status = 'pending';
                }
            } elseif (isset($decode['success'])) {
                if (isset($decode['data']['status'])) {
                    $status = $decode['success']['status'];
                    if ($status == 'Pending') {
                        $status = 'pending';
                    } elseif ($status == 'Processing' or $status == 'In Progress') {
                        $status = 'process';
                    } elseif ($status == 'Success') {
                        $status = 'done';
                    } elseif ($status == 'Partial') {
                        $status = 'partial';
                    } elseif ($status == 'Error') {
                        $status = 'error';
                    } else {
                        $status = 'refund';
                    }
                } else {
                    $status = 'pending';
                }
            }
            $provider = DB::table('service_providers')->orderBy('id', 'desc')->where('id', $row->provider_id)->first();
            if ($provider) {
                $name = $provider->name;
            } else {
                $name = 'not found';
            }
            $user = DB::table('user')->where('id', $row->user_id)->first();
            if ($user) {
                $user = User::where([['username', $user->username], ['email', $user->email]])->first();
                if ($row->custom_comments != null) {
                    $target = $row->target . '||' . $row->custom_comments;
                    $type = 'Custom Comments';
                } else {
                    $target = $row->target;
                    $type = 'Default';
                }
                History::create([
                    'user_id' => $user->id,
                    'trxid' => $row->provider_order_id,
                    'provider' => $name,
                    'type' => 'Default',
                    'service_id' => $row->service_id,
                    'layanan' => $row->service_name,
                    'target' => $target,
                    'quantity' => $row->quantity,
                    'price' => $row->price,
                    'start_count' => $row->start_count,
                    'remains' => $row->remains,
                    'status' => $status,
                    'refill' => '0',
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]);
                DB::table('orders')->where('id', $row->id)->delete();
            }
        }
    } else {
        DB::table('user')->delete();
    }
});
Route::get('migrasi2', function () {
    $user = DB::table('user')->get();
    $config = Config::first();
    foreach ($user as $row) {
        User::create([
            'username' => $row->username,
            'email' => $row->email,
            'password' => $row->password,
            'name' => $row->full_name,
            'whatsapp' => $row->phone_number,
            'balance' => $row->balance,
            'omzet' => 0,
            'level' => 'basic',
            'role' => $row->level == 'Admin' ? 'admin' : 'user',
            'api_key' => $row->api_key,
            'api_id' => rand(1000, 9999),
            'whitelist_ip' => $row->api_whitelist_ip,
            'is_mail' => '1',
            'gender' => 'male',
            'zona' => 'Asia/Jakarta',
            'image' => $config->default_image,
            'status' => $row->status == '1' ? 'active' : 'banned',
        ]);
    }
    $order = DB::table('orders')->get();
    if ($order->first()) {
        foreach ($order as $row) {
            $decode = json_decode($row->provider_status_log, true);
            // dd($decode['data']['status']);
            if (isset($decode['status'])) {
                if (isset($decode['data']['status'])) {
                    $status = $decode['data']['status'];
                    if ($status == 'Pending') {
                        $status = 'pending';
                    } elseif ($status == 'Processing' or $status == 'In Progress') {
                        $status = 'process';
                    } elseif ($status == 'Success') {
                        $status = 'done';
                    } elseif ($status == 'Partial') {
                        $status = 'partial';
                    } elseif ($status == 'Error') {
                        $status = 'error';
                    } else {
                        $status = 'refund';
                    }
                } else {
                    $status = 'pending';
                }
            } elseif (isset($decode['success'])) {
                if (isset($decode['data']['status'])) {
                    $status = $decode['success']['status'];
                    if ($status == 'Pending') {
                        $status = 'pending';
                    } elseif ($status == 'Processing' or $status == 'In Progress') {
                        $status = 'process';
                    } elseif ($status == 'Success') {
                        $status = 'done';
                    } elseif ($status == 'Partial') {
                        $status = 'partial';
                    } elseif ($status == 'Error') {
                        $status = 'error';
                    } else {
                        $status = 'refund';
                    }
                } else {
                    $status = 'pending';
                }
            }
            $provider = DB::table('service_providers')->orderBy('id', 'desc')->where('id', $row->provider_id)->first();
            if ($provider) {
                $name = $provider->name;
            } else {
                $name = 'not found';
            }
            $user = DB::table('user')->where('id', $row->user_id)->first();
            if ($user) {
                $user = User::where([['username', $user->username], ['email', $user->email]])->first();
                if ($row->custom_comments != null) {
                    $target = $row->target . '||' . $row->custom_comments;
                    $type = 'Custom Comments';
                } else {
                    $target = $row->target;
                    $type = 'Default';
                }
                History::create([
                    'user_id' => $user->id,
                    'trxid' => $row->provider_order_id,
                    'provider' => $name,
                    'type' => 'Default',
                    'service_id' => $row->service_id,
                    'layanan' => $row->service_name,
                    'target' => $target,
                    'quantity' => $row->quantity,
                    'price' => $row->price,
                    'start_count' => $row->start_count,
                    'remains' => $row->remains,
                    'status' => $status,
                    'refill' => '0',
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]);
                DB::table('orders')->where('id', $row->id)->delete();
            }
        }
    } else {
        DB::table('user')->delete();
    }
});
Route::get('migrasi3', function () {});
Route::get('delete-user', function () {
    $user = User::where('username', '!=', 'admin')->delete();
});
Route::controller(ApiController::class)->group(function () {
    Route::post('profile', 'profile')->name('profile');
    Route::post('services', 'services')->name('services');
    Route::post('order', 'order')->name('order');
    Route::post('status', 'status')->name('status');
    Route::post('refill', 'refill')->name('refill');
    Route::post('refill_status', 'status_refill')->name('status_refill');
});

Route::post('callback/paydisini', function (Request $request) {
    $config = Config::first();
    $decode = json_decode($config->provider_payment, true);
    $key = $decode['paydisini']['api_key'];
    $unique = $request->unique_code;
    $status = $request->status;
    if ($request->key == $key) {
        $deposit = Deposit::where('trxid', $unique)->first();
        if ($deposit) {
            if ($status == 'Success') {
                $deposit->status = 'done';
                $deposit->save();
                $user = User::find($deposit->user_id);
                if ($user) {
                    $user->balance = $user->balance + $deposit->diterima;
                    $user->save();
                    LogBalance::create([
                        'user_id' => $user->id,
                        'type' => 'Debit',
                        'kategori' => 'deposit',
                        'jumlah' => $deposit->diterima,
                        'before_balance' => $user->balance - $deposit->diterima,
                        'after_balance' => $user->balance,
                        'description' => '#' . $deposit->trxid . ' Deposit saldo berhasil via ' . $deposit->name . ' ' . $deposit->name_payment
                    ]);
                }
            } else {
                $deposit->status = 'canceled';
                $deposit->save();
            }
            return response()->json(['status' => true]);
        } else {
            $history = HistoryOrder::where('trxid', $unique)->first();
            if ($history) {
                $smm = Smm::where('service', $history->service_id)->first();
                if ($status == 'Success') {
                    $history->status_payment = 'done';
                    if ($smm) {
                        if ($history->status == 'pending') {
                            $provider = Provider::where('nama', $smm->provider)->first();
                            if (!$provider) {
                                return redirect()->back()->with('error', 'Provider tidak ditemukan');
                            }
                            $decode = json_decode($provider->json, true);
                            $permintaan = $decode['permintaan']['order'];
                            $data = [
                                $permintaan['service'] => $smm->service,
                                $permintaan['target'] => $history->target,
                                $permintaan['quantity'] => $history->quantity,
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
                            $ord = new HelpersSmm($smm->provider);
                            $order = $ord->order($data);
                            $dataresponse = $decode['response']['order']['order_id'];
                            $validate = getValueByPath2($order, $dataresponse);
                            if ($validate != false) {
                                $history->order_id = $validate;
                                $history->status = 'pending';
                                $history->save();
                                return response()->json(['status' => true]);
                            } else {
                                $history->status = 'error';
                                $history->save();
                                return response()->json(['status' => false]);
                            }
                        } else {
                            return response()->json(['status' => false]);
                        }
                    } else {
                        $history->status = 'error';
                        $history->save();
                        return response()->json(['status' => false]);
                    }
                } else {
                    $history->status = 'error';
                    $history->status_payment = 'canceled';
                    $history->save();
                    return response()->json(['status' => false]);
                }
            } else {
                $history->status = 'error';
                $history->status_payment = 'canceled';
                $history->save();
                return response()->json(['status' => false]);
            }
        }
        return response()->json(['status' => false]);
    } else {
        return response()->json(['status' => false]);
    }
});
Route::post('callback/tripay', function (Request $request) {
    $json = file_get_contents('php://input');
    $callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE'])
        ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE']
        : '';
    $config = Config::first();
    $decode = json_decode($config->provider_payment, true);
    $key = $decode['tripay']['api_key'];
    $signature = hash_hmac('sha256', $json, $key);

    // Validasi signature
    if ($callbackSignature !== $signature) {
        exit(json_encode([
            'success' => false,
            'message' => 'Invalid signature',
        ]));
    }
    $data = json_decode($json);
    $deposit = Deposit::where('trxid', $data->merchant_ref)->first();
    if ($deposit) {
        if ($data->status == 'Success') {
            $deposit->status = 'done';
            $deposit->save();
            $user = User::find($deposit->user_id);
            if ($user) {
                $user->balance = $user->balance + $deposit->diterima;
                $user->save();
            }
        } else {
            $deposit->status = 'canceled';
            $deposit->save();
        }
        return response()->json(['status' => true]);
    } else {
        $history = HistoryOrder::where('trxid', $data->merchant_ref)->first();
        if ($history) {
            if ($data->status == 'PAID') {
                $smm = Smm::where('service', $history->service_id)->first();
                $history->status_payment = 'done';
                if ($smm) {
                    $provider = Provider::where('nama', $smm->provider)->first();
                    if (!$provider) {
                        return redirect()->back()->with('error', 'Provider tidak ditemukan');
                    }
                    $decode = json_decode($provider->json, true);
                    $permintaan = $decode['permintaan']['order'];
                    $data = [
                        $permintaan['service'] => $smm->service,
                        $permintaan['target'] => $history->target,
                        $permintaan['quantity'] => $history->quantity,
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
                    $ord = new HelpersSmm($smm->provider);
                    $order = $ord->order($data);
                    $dataresponse = $decode['response']['order']['order_id'];
                    $validate = getValueByPath2($order, $dataresponse);
                    if ($validate != false) {
                        $user = User::find($deposit->user_id);
                        return response()->json(['status' => true]);
                    } else {
                        $history->status = 'error';
                        $history->save();
                        return response()->json(['status' => false]);
                    }
                } else {
                    $history->status = 'error';
                    $history->save();
                    return response()->json(['status' => false]);
                }
            } else {
                $history->status = 'error';
                $history->status_payment = 'canceled';
                $history->save();
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
});
function checknumber($phone)
{
    $config = BotConfig::first();
    $data = [
        'api_key' => $config->api_key,
        'device_key' => $config->device_key,
        'phone_number' => $phone,
    ];
    $data = json_encode($data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wapisender.id/api/v5/check_number',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function Senderwhatsapp($type, $data)
{
    try {
        $user_id = $data['user_id'] ?? null;
        if ($user_id == null) {
            $user = User::find(Auth::user()->id);
        } else {
            $user = User::find($data['user_id']);
        }
        $config = BotConfig::first();
        $bot = Bot::where('user_id', $user->id)->where('type', 'whatsapp')->where('status', '1')->first();
        if ($bot) {
            if ($type == 'batas_saldo') {
                $message = batas_saldo($config, $data);
            } elseif ($type == 'max_pesanan') {
                $message = max_pesanan($config, $data);
            } elseif ($type == 'notif_deposit') {
                $message = notif_deposit($config, $data);
            } elseif ($type == 'notif_tiket') {
                $message = notif_tiket($config, $data);
            } elseif ($type == 'reply_tiket') {
                $message = reply_tiket($config, $data);
            } elseif ($type == 'forgot_password') {
                $message = forgot_password($config, $data, $user);
            } else {
                $message = null;
            }
            $decode = json_decode($config->konfigurasi, true);
            $data = [
                $decode['api_key'] => $config->api_key,
                $decode['device_key'] => $config->device_key,
                $decode['target'] => $bot->number,
                $decode['message'] => $message,
            ];
            $data = json_encode($data);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $config->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 15,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        }
    } catch (\Throwable $th) {
        return false;
    }
}
function batas_saldo($config, $data)
{
    $message = $config->batas_saldo;
    $message = str_replace('((name_user))', Auth::user()->name, $message);
    $message = str_replace('((email_user))', Auth::user()->email, $message);
    $message = str_replace('((balance_user))', $data, $message);
    $message = str_replace('((date_time))', Carbon::now()->format('d-m-Y H:i:s'), $message);
    return $message;
}
function max_pesanan($config, $data)
{
    $message = $config->max_pesanan;
    $message = str_replace('((name_user))', Auth::user()->name, $message);
    $message = str_replace('((email_user))', Auth::user()->email, $message);
    $message = str_replace('((price_pesanan))', 'Rp ' . $data['harga_pesanan'], $message);
    $message = str_replace('((pesanan))', $data['pesanan'], $message);
    $message = str_replace('((date_time))', Carbon::now()->format('d-m-Y H:i:s'), $message);
    return $message;
}

function notif_deposit($config, $data)
{
    $message = $config->notif_deposit;
    $message = str_replace('((name_user))', Auth::user()->name, $message);
    $message = str_replace('((email_user))', Auth::user()->email, $message);
    $message = str_replace('((order_id))', $data['order_id'], $message);
    $message = str_replace('((channel_pembayaran))', $data['channel'], $message);
    $message = str_replace('((nominal))', $data['nominal'], $message);
    $message = str_replace('((expired))', $data['expired'], $message);
    $message = str_replace('((date_time))', Carbon::now()->format('d-m-Y H:i:s'), $message);
    return $message;
}
function notif_tiket($config, $data)
{
    $message = $config->notif_tiket;
    $message = str_replace('((name_user))', Auth::user()->name, $message);
    $message = str_replace('((email_user))', Auth::user()->email, $message);
    $message = str_replace('((tiket_id))', $data['tiket_id'], $message);
    $message = str_replace('((subjek))', $data['subjek'], $message);
    $message = str_replace('((tipe_id))', $data['tipe_id'], $message);
    $message = str_replace('((message))', $data['message'], $message);
    return $message;
}
function reply_tiket($config, $data)
{
    $message = $config->reply_tiket;
    $message = str_replace('((name_user))', Auth::user()->name, $message);
    $message = str_replace('((email_user))', Auth::user()->email, $message);
    $message = str_replace('((tiket_id))', $data['tiket_id'], $message);
    $message = str_replace('((message))', $data['message'], $message);
    return $message;
}
function forgot_password($config, $data, $user)
{
    $message = $config->forgot_password;
    $message = str_replace('((name_user))', $user->name, $message);
    $message = str_replace('((email_user))', $user->email, $message);
    $message = str_replace('((link))', $data['link'], $message);
    return $message;
}
function tanggal($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
Route::get('json', function () {

    $provider = Provider::find(5);
    return $provider->json;
});
function verifyCloudflare($data)
{
    $turnstile_secret     = env('CLOUDFLARE_SECRET');
    $turnstile_response   = $data;
    $url                  = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
    $post_fields          = "secret=$turnstile_secret&response=$turnstile_response";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response);
    if ($response_data->success != 1) {
        return false;
    } else {
        return true;
    }
}
function getValueByPath($array, $path)
{
    try {
        $keys = explode("']['", trim($path, "[]"));
        $keys = array_map(function ($key) {
            return trim($key, "'");
        }, $keys);
        // dd($keys, $array);
        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $array = $array[$key];
            } else {
                return json_encode(['status' => false, 'data' => 'Data tidak ditemukan, silahkan cek kembali data yang anda masukkan']);
            }
        }
        return json_encode(['status' => true, 'data' => $array]);
    } catch (\Throwable $th) {
        return json_encode(['status' => false, 'data' => $th->getMessage()]);
    }
}
function getValueByPath2($array, $path)
{
    try {
        $keys = explode("']['", trim($path, "[]"));
        $keys = array_map(function ($key) {
            return trim($key, "'");
        }, $keys);
        // dd($keys, $array);
        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $array = $array[$key];
            } else {
                return false; // Mengembalikan null jika kunci tidak ditemukan
            }
        }
        return $array;
    } catch (\Throwable $th) {
        return false;
    }
}
function random($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function random2($length)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function search($rows, $value)
{
    $value = replacearray($value);
    $value = explode(',', $value);
    $value = getNestedValue($rows, $value);
    return $value;
}
function getNestedValue($array, $keys)
{
    foreach ($keys as $key) {
        if (isset($array[$key])) {
            $array = $array[$key];
        } else {
            return null;
        }
    }
    return $array;
}
function replacearray($array)
{
    $array = str_replace('[', '', $array);
    $array = str_replace(']', '', $array);
    $array = str_replace("'", '', $array);
    return $array;
}

function genSignature($data, $credentials)
{
    $body = json_encode($data, JSON_UNESCAPED_SLASHES);
    $requestBody  = strtolower(hash('sha256', $body));
    $secret       = $credentials['apikey'];
    $va           = $credentials['va'];
    $stringToSign = 'GET:' . $va . ':' . $requestBody . ':' . $secret;
    $signature    = hash_hmac('sha256', $stringToSign, $secret);

    return $signature;
}
