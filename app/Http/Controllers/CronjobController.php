<?php

namespace App\Http\Controllers;

use App\Helpers\Smm;
use App\Libraries\Paydisini;
use App\Libraries\Tripay;
use App\Livewire\Admin\LogSaldo;
use App\Models\Category;
use App\Models\Config;
use App\Models\Deposit;
use App\Models\History;
use App\Models\HistoryOrder;
use App\Models\HistoryRefill;
use App\Models\LogBalance;
use App\Models\MetodePembayaran;
use App\Models\Provider;
use App\Models\Smm as ModelsSmm;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use iPaymu\iPaymu;
use ZerosDev\TriPay\Callback;
use ZerosDev\TriPay\Client as TriPayClient;


class CronjobController extends Controller
{
    public function MetodePayment()
    {
        // $paydisini = new Paydisini();
        // $decode = json_decode($paydisini->service());
        // try {
        //     if ($decode->success == true) {
        //         foreach ($decode->data as $data) {
        //             $cek = MetodePembayaran::where([['provider', 'paydisini'], ['code', $data->id]])->first();
        //             if (strpos($data->fee, '%') !== false) {
        //                 $rate = 'percent';
        //             } else {
        //                 $rate = 'fixed';
        //             }
        //             if ($cek) {
        //                 $cek->update([
        //                     'provider' => 'paydisini',
        //                     'type_proses' => 'otomatis',
        //                     'type_payment' => 'TRANSFER ' . $data->type,
        //                     'code' => $data->id,
        //                     'name' => $data->name,
        //                     'rate_type' => $rate,
        //                     'rate' => str_replace('%', '', $data->fee),
        //                     'bonus' => '[]',
        //                     'min_nominal' => $data->minimum,
        //                     'max_nominal' => $data->maximum,
        //                     'account_number' => 'POWERED BY PAYDISINI',
        //                     'account_name' => 'POWERED BY PAYDISINI',
        //                     'image' => $data->img,
        //                     'status' => 'active',
        //                 ]);
        //             } else {
        //                 MetodePembayaran::create([
        //                     'provider' => 'paydisini',
        //                     'type_proses' => 'otomatis',
        //                     'type_payment' => 'TRANSFER ' . $data->type,
        //                     'code' => $data->id,
        //                     'name' => $data->name,
        //                     'rate_type' => $rate,
        //                     'rate' => str_replace('%', '', $data->fee),
        //                     'bonus' => '[]',
        //                     'min_nominal' => $data->minimum,
        //                     'max_nominal' => $data->maximum,
        //                     'account_number' => 'POWERED BY PAYDISINI',
        //                     'account_name' => 'POWERED BY PAYDISINI',
        //                     'image' => $data->img,
        //                     'status' => 'active',
        //                 ]);
        //             }
        //         }
        //     }
        // } catch (\Throwable $e) {
        // }
        $tripay = new Tripay();
        $decode = json_decode($tripay->services());
        if ($decode->success == true) {
            foreach ($decode->data as $data) {
                $cek = MetodePembayaran::where([['provider', 'tripay'], ['code', $data->code]])->first();
                if ($data->total_fee->flat != 0) {
                    $rate = 'fixed';
                } else {
                    $rate = 'percent';
                }
                if ($cek) {
                    $cek->update([
                        'provider' => 'tripay',
                        'type_proses' => 'otomatis',
                        'type_payment' => 'TRANSFER ' . $data->group,
                        'code' => $data->code,
                        'name' => $data->name,
                        'rate_type' => $rate,
                        'rate' => str_replace('%', '', $data->fee),
                        'bonus' => '[]',
                        'min_nominal' => $data->minimum_amount,
                        'max_nominal' => $data->maximum_amount,
                        'account_number' => 'POWERED BY TRIPAY',
                        'account_name' => 'POWERED BY TRIPAY',
                        'image' => $data->icon_url,
                        'status' => 'active',
                    ]);
                } else {
                    MetodePembayaran::create([
                        'provider' => 'tripay',
                        'type_proses' => 'otomatis',
                        'type_payment' => 'TRANSFER ' . $data->group,
                        'code' => $data->code,
                        'name' => $data->name,
                        'rate_type' => $rate,
                        'rate' => str_replace('%', '', $data->fee),
                        'bonus' => '[]',
                        'min_nominal' => $data->minimum_amount,
                        'max_nominal' => $data->maximum_amount,
                        'account_number' => 'POWERED BY TRIPAY',
                        'account_name' => 'POWERED BY TRIPAY',
                        'image' => $data->icon_url,
                        'status' => 'active',
                    ]);
                }
            }
        }
        // $ipaymu = new iPaymu(true);
        // $channel = json_decode($ipaymu->channel());

        // if ($channel->Status == 200 && $channel->Success == true) {
        //     foreach ($channel->Data as $row) {
        //         $cek = MetodePembayaran::where([['provider', 'ipaymu'], ['status', $row->Code]])->first();
        //         if ($cek) {
        //             foreach ($row->Channels as $rows) {
        //                 $fee = $rows->TransactionFee;
        //                 if ($fee->ActualFeeType == 'FLAT') {
        //                     $rate = 'fixed';
        //                 } else {
        //                     $rate = 'percent';
        //                 }
        //                 $cek->update([
        //                     'provider' => 'ipaymu',
        //                     'type_proses' => 'otomatis',
        //                     'type_payment' => 'TRANSFER ' . strtoupper($row->Code),
        //                     'code' => $rows->Code,
        //                     'name' => $rows->Name,
        //                     'rate_type' => $rate,
        //                     'rate' =>  $fee->ActualFee,
        //                     'bonus' => '[]',
        //                     'min_nominal' => $rows->minimum ?? 0,
        //                     'max_nominal' => $rows->maximum ?? 0,
        //                     'account_number' => 'POWERED BY IPAYMU',
        //                     'account_name' => 'POWERED BY IPAYMU',
        //                     'image' => $rows->Logo,
        //                     'status' => 'active',
        //                 ]);
        //             }
        //         } else {
        //             foreach ($row->Channels as $rows) {
        //                 $fee = $rows->TransactionFee;
        //                 if ($fee->ActualFeeType == 'FLAT') {
        //                     $rate = 'fixed';
        //                 } else {
        //                     $rate = 'percent';
        //                 }
        //                 MetodePembayaran::create([
        //                     'provider' => 'ipaymu',
        //                     'type_proses' => 'otomatis',
        //                     'type_payment' => 'TRANSFER ' . strtoupper($row->Code),
        //                     'code' => $rows->Code,
        //                     'name' => $rows->Name,
        //                     'rate_type' => $rate,
        //                     'rate' =>  $fee->ActualFee,
        //                     'bonus' => '[]',
        //                     'min_nominal' => $rows->minimum ?? 0,
        //                     'max_nominal' => $rows->maximum ?? 0,
        //                     'account_number' => 'POWERED BY IPAYMU',
        //                     'account_name' => 'POWERED BY IPAYMU',
        //                     'image' => $rows->Logo,
        //                     'status' => 'active',
        //                 ]);
        //             }
        //         }
        //     }
        // }
    }
    public function layanan()
    {
        $config = Cache::remember('config', 30, function () {
            return Config::first();
        });

        $decode = json_decode($config->cronjob, true);
        if ($decode['auto_update'] == true) {
            $provider = Cache::remember('active_providers', 30, function () {
                return Provider::where('json', '!=', 'json')->where([['status', 'aktif'], ['proses_manual', '0']])->get();
            });



            foreach ($provider as $row) {
                if (Schema::hasColumn('providers', 'auto_delete')) {
                    if ($row->auto_delete == '1') {
                        ModelsSmm::where('provider', $row->nama)->delete();
                        Category::where('provider', $row->nama)->delete();
                    }
                } else {
                    DB::statement("ALTER TABLE providers ADD COLUMN auto_delete enum('0','1') NOT NULL DEFAULT '1' AFTER replace_text");
                }

                $decode = json_decode($row->json, true);
                $permintaan = $decode['permintaan']['service'];
                $data = [
                    $permintaan['provider_key'] => $decode['provider_key']
                ];

                if (!$decode['provider_id'] == '-' || !$permintaan['provider_id'] == null) {
                    $data[$permintaan['provider_id']] = $decode['provider_id'];
                }

                if ($permintaan['action'] != null) {
                    $data['action'] = $permintaan['action'];
                }

                if ($permintaan['provider_secret'] != null) {
                    $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                }

                dd($data);
                $smm = new Smm($row->nama);
                // hasil response API request
                $result = $smm->services($data);
                echo "<pre>";
                print_r($result);
                echo "</pre>";

                try {
                    $count = count($result);
                } catch (\Throwable $e) {
                    return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
                }

                if (isset($result['success']) || isset($result['status']) || isset($result['response']) || $count > 3) {
                    $response = $decode['response']['service'];
                    $kategori = [];
                    $kate = [];

                    if ($response) {
                        // fungsi search adalah mencari jarum (params 2) dalam jerami (params 1)

                        // loop adalah data tanpa bungkusan
                        $loop = search($result, $response['looping']) ?: $result;
                        $existingSmms = ModelsSmm::where('provider', $row->nama)
                            ->get()
                            ->keyBy('service');

                        foreach ($loop as $rows) {
                            $replace = json_decode($row->replace_text, true);
                            $name = search($rows, $response['name']);
                            $category = search($rows, $response['category']);
                            $description = search($rows, $response['description']);

                            foreach ($replace as $value) {
                                $name = str_replace($value['text'], $value['replace'], $name);
                                $description = str_replace($value['text'], $value['replace'], $description);
                                $category = str_replace($value['text'], $value['replace'], $category);
                            }

                            // id layanan
                            $service = search($rows, $response['id']);

                            $pricenormal = search($rows, $response['price']) * $row->rate;
                            $total = $pricenormal;
                            $profitData = json_decode($row->profit, true);

                            if (is_array($profitData)) {
                                foreach (array_reverse($profitData) as $key => $item) {
                                    $max = (int)$item['max'];
                                    $min = (int)$item['min'];
                                    $profit = (int)$item['profit'];
                                    $type = $item['type'];

                                    if (($pricenormal >= $max && $key == '4') || $pricenormal >= $min) {
                                        if ($type == 'percent') {
                                            $total = $pricenormal + (($pricenormal / 100) * $profit);
                                        } elseif ($type == 'fixed') {
                                            $total = $pricenormal + $profit;
                                        } else {
                                            $total = $pricenormal - $profit;
                                        }
                                        break;
                                    }
                                }
                            }

                            if ($existingSmms->has($service)) {
                                $existingSmms[$service]->update([
                                    'provider' => $row->nama,
                                    'type' => search($rows, $response['type']),
                                    'name' => $name,
                                    'service' => $service,
                                    'category' => $category,
                                    'refill' => search($rows, $response['refill']) == null ? '0' : '1',
                                    'price' => $total,
                                    'min' => search($rows, $response['min']),
                                    'max' => search($rows, $response['max']),
                                    'description' => $description,
                                    'average_time' => search($rows, $response['average_time']),
                                    'cancel' => search($rows, $response['cancel']) ?? false,
                                    'status' => 'aktif',
                                ]);
                            } else {
                                if ($row->auto_delete == '1') {
                                    ModelsSmm::create([
                                        'provider' => $row->nama,
                                        'type' => search($rows, $response['type']),
                                        'name' => $name,
                                        'service' => $service,
                                        'category' => $category,
                                        'refill' => search($rows, $response['refill']) == null ? '0' : '1',
                                        'price' => $total,
                                        'min' => search($rows, $response['min']),
                                        'max' => search($rows, $response['max']),
                                        'description' => $description,
                                        'average_time' => search($rows, $response['average_time']),
                                        'cancel' => search($rows, $response['cancel']) ?? false,
                                        'status' => 'aktif',
                                    ]);
                                }
                            }

                            if ($category) {
                                $kategori[$service] = $category;
                                $kate[] = $category;
                            }
                        }
                    }

                    $text = null;
                    $kategori = array_unique($kategori);
                    $kate = array_unique($kate);

                    $existingCategories = Category::where('provider', $row->nama)
                        ->whereIn('sid', array_keys($kategori))
                        ->get()
                        ->keyBy('sid');

                    foreach ($kategori as $sid => $value) {
                        if ($existingCategories->has($sid)) {
                            $existingCategories[$sid]->update(['kategori' => $value]);
                        } else {
                            if ($row->auto_delete == '1') {
                                Category::create([
                                    'sid' => $sid,
                                    'provider' => $row->nama,
                                    'kategori' => $value,
                                    'nologin' => $row->auto_nologin
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
    public function layanans($nama)
    {
        $config = Cache::remember('config', 30, function () {
            return Config::first();
        });

        $decode = json_decode($config->cronjob, true);
        if ($decode['auto_update'] == true) {
            $provider = Provider::where('nama', $nama)->first();
            if (!$provider) {
                return response()->json(['status' => 'error', 'message' => 'Provider tidak ditemukan']);
            }

            if (Schema::hasColumn('providers', 'auto_delete')) {
                if ($provider->auto_delete == '1') {
                    ModelsSmm::where('provider', $provider->nama)->delete();
                    Category::where('provider', $provider->nama)->delete();
                }
            } else {
                DB::statement("ALTER TABLE providers ADD COLUMN auto_delete enum('0','1') NOT NULL DEFAULT '1' AFTER replace_text");
            }
            $decode = json_decode($provider->json, true);
            $permintaan = $decode['permintaan']['service'];
            $data = [
                $permintaan['provider_key'] => $decode['provider_key']
            ];

            if (!$decode['provider_id'] == '-' || !$permintaan['provider_id'] == null) {
                $data[$permintaan['provider_id']] = $decode['provider_id'];
            }

            if ($permintaan['action'] != null) {
                $data['action'] = $permintaan['action'];
            }

            if ($permintaan['provider_secret'] != null) {
                $data[$permintaan['provider_secret']] = $decode['provider_secret'];
            }

            $smm = new Smm($provider->nama);
            // hasil request dari API
            $result = $smm->services($data);
            try {
                $count = count($result);
                if (isset($result['success']) || isset($result['status']) || isset($result['response']) || $count > 3) {
                    $response = $decode['response']['service'];
                    $kategori = [];
                    $kate = [];

                    if ($response) {
                        $loop = search($result, $response['looping']) ?: $result;
                        $existingSmms = ModelsSmm::where('provider', $provider->nama)
                            ->get()
                            ->keyBy('service');

                        foreach ($loop as $rows) {
                            $replace = json_decode($provider->replace_text, true);
                            $name = search($rows, $response['name']);
                            $category = search($rows, $response['category']);
                            $description = search($rows, $response['description']);

                            foreach ($replace as $value) {
                                $name = str_replace($value['text'], $value['replace'], $name);
                                $description = str_replace($value['text'], $value['replace'], $description);
                                $category = str_replace($value['text'], $value['replace'], $category);
                            }

                            $service = search($rows, $response['id']);
                            $pricenormal = search($rows, $response['price']) * $provider->rate;
                            $total = $pricenormal;
                            $profitData = json_decode($provider->profit, true);
                            if (is_array($profitData)) {
                                foreach (array_reverse($profitData) as $key => $item) {
                                    $max = (int)$item['max'];
                                    $min = (int)$item['min'];
                                    $profit = (int)$item['profit'];
                                    $type = $item['type'];

                                    if (($pricenormal >= $max && $key == '4') || $pricenormal >= $min) {
                                        if ($type == 'percent') {
                                            $total = $pricenormal + (($pricenormal / 100) * $profit);
                                        } elseif ($type == 'fixed') {
                                            $total = $pricenormal + $profit;
                                        } else {
                                            $total = $pricenormal - $profit;
                                        }
                                        break;
                                    }
                                }
                            }
                            if ($existingSmms->has($service)) {
                                $existingSmms[$service]->update([
                                    'provider' => $provider->nama,
                                    'type' => search($rows, $response['type']),
                                    'name' => $name,
                                    'service' => $service,
                                    'category' => $category,
                                    'refill' => search($rows, $response['refill']) == null ? '0' : '1',
                                    'price' => $total,
                                    'min' => search($rows, $response['min']),
                                    'max' => search($rows, $response['max']),
                                    'description' => $description,
                                    'average_time' => search($rows, $response['average_time']),
                                    'status' => 'aktif',
                                ]);
                            } else {
                                if ($provider->auto_delete == '1') {
                                    ModelsSmm::create([
                                        'provider' => $provider->nama,
                                        'type' => search($rows, $response['type']),
                                        'name' => $name,
                                        'service' => $service,
                                        'category' => $category,
                                        'refill' => search($rows, $response['refill']) == null ? '0' : '1',
                                        'price' => $total,
                                        'min' => search($rows, $response['min']),
                                        'max' => search($rows, $response['max']),
                                        'description' => $description,
                                        'average_time' => search($rows, $response['average_time']),
                                        'status' => 'aktif',
                                    ]);
                                }
                            }
                            if ($category) {
                                $kategori[$service] = $category;
                                $kate[] = $category;
                            }
                        }
                    }

                    $text = null;
                    $kategori = array_unique($kategori);
                    $kate = array_unique($kate);

                    $existingCategories = Category::where('provider', $provider->nama)
                        ->whereIn('sid', array_keys($kategori))
                        ->get()
                        ->keyBy('sid');

                    foreach ($kategori as $sid => $value) {
                        if ($existingCategories->has($sid)) {
                            $existingCategories[$sid]->update(['kategori' => $value]);
                        } else {
                            if ($provider->auto_delete == '1') {
                                Category::create([
                                    'sid' => $sid,
                                    'provider' => $provider->nama,
                                    'kategori' => $value,
                                    'nologin' => $provider->auto_nologin
                                ]);
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
    public function deleteCategory()
    {
        $categories = Category::with('smm')->get(); // Assuming relasi bernama 'smms'

        foreach ($categories as $category) {
            if ($category->smm->isEmpty()) { // Cek apakah ada Smm yang terkait
                $category->delete();
            }
        }
    }
    public function category()
    {
        $category = Category::all();
        foreach ($category as $row) {
            $smm = ModelsSmm::where('category', $row->kategori)->where('provider', $row->provider)->first();
            if (!$smm) {
                $row->delete();
            }
        }
    }
    public function status_pesanan()
    {
        $config = Config::first();
        $decode = json_decode($config->cronjob, true);
        if ($decode['auto_update_status'] == true) {
            // ambil data history yg statusnya pending / process
            $history = History::where('status', 'pending')->orWhere('status', 'process')->get();
            if ($history->first()) {
                foreach ($history as $row) {
                    // ambil id user
                    $user = User::find($row->user_id);
                    // ambil provider aktif
                    $provider = Provider::where('nama', $row->provider)->where([['status', 'aktif'], ['proses_manual', '0']])->first();
                    if ($provider) {
                        // ambil data json di database provider, jadikan array
                        $decode = json_decode($provider->json, true);
                        $permintaan = $decode['permintaan']['status'];
                        // ambil transaksi id dari pesanan yg belum sukses
                        $row->trxid = (string) $row->trxid;
                        $data = [
                            $permintaan['order_id'] => $row->trxid,
                        ];
                        $data[$permintaan['provider_key']] = $decode['provider_key'];
                        if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                            $data[$permintaan['provider_id']] = $decode['provider_id'];
                        }
                        if ($permintaan['provider_secret'] != null) {
                            $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                        }
                        if ($permintaan['action'] != null) {
                            $data['action'] = $permintaan['action'];
                        }
                        $smm = new Smm($row->provider);
                        $smm = $smm->status($data);
                        dump($smm);
                        if (isset($smm['status']) or isset($smm['success']) or isset($smm['response']) == true) {
                            $total = 0;
                            $count = 0;
                            $status = strtolower(getValueByPath2($smm, $decode['response']['status']['status']));
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
                                    $kurang = $row->quantity - $remains;
                                    $total = ($row->price / 1000) * $kurang;
                                    $total = ceil($total);
                                    LogBalance::create([
                                        'user_id' => $row->user_id,
                                        'kategori' => 'refund',
                                        'jumlah' => $row->price,
                                        'before_balance' => $user->balance,
                                        'after_balance' => $user->balance + $row->price,
                                        'description' => 'Partial Order #' . $row->trxid . ' dengan jumlah pengembalian Rp ' . $this->format($row->price),
                                    ]);
                                    $user->balance = $user->balance + $total;
                                    $user->save();
                                }
                                $status = 'partial';
                            } elseif ($status == strtolower($decode['status_value']['status']['error'])) {
                                if ($user) {
                                    LogBalance::create([
                                        'user_id' => $row->user_id,
                                        'kategori' => 'refund',
                                        'jumlah' => $row->price,
                                        'before_balance' => $user->balance,
                                        'after_balance' => $user->balance + $row->price,
                                        'description' => 'Error Order #' . $row->trxid . ' dengan jumlah Rp ' . $this->format($row->price),
                                    ]);
                                    $user->balance = $user->balance + $row->price;
                                    $user->save();
                                }
                                $status = 'error';
                            } else {
                                if ($user) {
                                    LogBalance::create([
                                        'user_id' => $row->user_id,
                                        'kategori' => 'refund',
                                        'jumlah' => $row->price,
                                        'before_balance' => $user->balance,
                                        'after_balance' => $user->balance + $row->price,
                                        'description' => 'Refund Order #' . $row->trxid . ' dengan jumlah Rp ' . $this->format($row->price),
                                    ]);
                                    $user->balance = $user->balance + $row->price;
                                    $user->save();
                                }
                                $status = 'refund';
                            }
                            $row->status = $status;
                            $row->start_count = $start_count;
                            $row->remains = $remains;
                            $row->save();
                            if ($status == 'done') {
                                $history = History::where('layanan', $row->layanan)
                                    ->where('status', 'done')
                                    ->get();

                                $totalWaktu = 0;
                                $jumlahData = $history->count();

                                foreach ($history as $rows) {
                                    $waktuProses = $rows->updated_at->diffInSeconds($rows->created_at);
                                    $totalWaktu += $waktuProses;
                                }

                                if ($jumlahData > 0) {
                                    $rataRataWaktu = abs($totalWaktu / $jumlahData); // Ubah nilai negatif menjadi positif

                                    $waktuFormat = [];

                                    if ($rataRataWaktu >= 86400) { // Jika ada hari
                                        $waktuFormat[] = sprintf("%d hari", ($rataRataWaktu / 86400));
                                        $rataRataWaktu %= 86400; // Kurangi waktu yang sudah dihitung dalam hari
                                    }
                                    if ($rataRataWaktu >= 3600) { // Jika ada jam
                                        $waktuFormat[] = sprintf("%02d jam", ($rataRataWaktu / 3600));
                                        $rataRataWaktu %= 3600; // Kurangi waktu yang sudah dihitung dalam jam
                                    }
                                    if ($rataRataWaktu >= 60) { // Jika ada menit
                                        $waktuFormat[] = sprintf("%02d menit", ($rataRataWaktu / 60));
                                    }
                                    if ($rataRataWaktu % 60 > 0) { // Jika ada detik
                                        $waktuFormat[] = sprintf("%02d detik", $rataRataWaktu % 60);
                                    }

                                    $rata = sprintf(
                                        implode(' ', $waktuFormat)
                                    );
                                    $layanan = ModelsSmm::where('name', $row->layanan)->first();
                                    if ($layanan) {
                                        $layanan->update([
                                            'average_time' => $rata,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $history = HistoryOrder::where('status', 'pending')->orWhere('status', 'processing')->get();
                foreach ($history as $row) {
                    $user = User::find($row->user_id);
                    $provider = Provider::where('nama', $row->provider)->first();
                    if ($provider) {
                        $decode = json_decode($provider->json, true);
                        $permintaan = $decode['permintaan']['status'];
                        $row->order_id = (string) $row->order_id;
                        $data = [
                            $permintaan['order_id'] => $row->order_id,
                        ];
                        $data[$permintaan['provider_key']] = $decode['provider_key'];
                        if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                            $data[$permintaan['provider_id']] = $decode['provider_id'];
                        }
                        if ($permintaan['provider_secret'] != null) {
                            $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                        }
                        if ($permintaan['action'] != null) {
                            $data['action'] = $permintaan['action'];
                        }
                        $smm = new Smm($row->provider);
                        $smm = $smm->status($data);
                        if (isset($smm['status']) == true or isset($smm['success']) == true or isset($smm['response']) == true) {
                            $total = 0;
                            $count = 0;
                            $status = strtolower(getValueByPath2($smm, $decode['response']['status']['status']));
                            $start_count = getValueByPath2($smm, $decode['response']['status']['start_count']);
                            $remains = getValueByPath2($smm, $decode['response']['status']['remains']);
                            if ($status == strtolower($decode['status_value']['status']['pending'])) {
                                $status = 'pending';
                            } elseif ($status == strtolower($decode['status_value']['status']['processing']) or $status == 'in progress') {
                                $status = 'processing';
                            } elseif ($status == strtolower($decode['status_value']['status']['success'])) {
                                $status = 'done';
                            } elseif ($status == strtolower($decode['status_value']['status']['partial'])) {
                                $status = 'partial';
                            } elseif ($status == strtolower($decode['status_value']['status']['error'])) {
                                $status = 'error';
                            } else {
                                $status = 'refund';
                            }
                            $row->status = $status;
                            $row->start_count = $start_count;
                            $row->remains = $remains;
                            $row->save();
                        }
                    }
                }
            }
        }
    }
    public function status_refill()
    {
        $config = Config::first();
        $decode = json_decode($config->cronjob, true);
        if ($decode['auto_status_refill'] == true) {
            $history = HistoryRefill::where('status', 'pending')->get();
            foreach ($history as $row) {
                $provider = Provider::where('nama', $row->provider)->first();
                if ($provider) {
                    $decode = json_decode($provider->json, true);
                    $permintaan = $decode['permintaan']['refill_status'];
                    $row->refill_id = (string) $row->refill_id;
                    $data = [
                        $permintaan['refill_id'] => $row->refill_id,
                    ];
                    $data[$permintaan['provider_key']] = $decode['provider_key'];
                    if (!$decode['provider_id'] == '-' or !$permintaan['provider_id'] == null) {
                        $data[$permintaan['provider_id']] = $decode['provider_id'];
                    }
                    if ($permintaan['provider_secret'] != null) {
                        $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                    }
                    if ($permintaan['action'] != null) {
                        $data['action'] = $permintaan['action'];
                    }
                    $smm = new Smm($row->provider);
                    $smm = $smm->refill_status($data);
                    if (isset($smm['status']) or isset($smm['success'])) {
                        $status = getValueByPath2($smm, $decode['response']['refill_status']['status']);
                        if ($status == $decode['status_value']['refill_status']['pending']) {
                            $status = 'pending';
                        } elseif ($status == $decode['status_value']['refill_status']['processing']) {
                            $status = 'processing';
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
                        $row->update([
                            'status' => $status,
                        ]);
                    }
                }
            }
        }
    }
    function format($num)
    {
        return number_format($num, 0, ",", ".");
    }

    // public function tripayCallback()
    // {
    //     $config = Config::first();
    //     if ($config) {
    //         // $merchantCode = 'T24304';
    //         // $apiKey = 'DEV-tiNV5Xzhf8JAsTYxCqG1KycZ3OTKIVcOsrCdLO5g';
    //         // $privateKey = 't4b2Z-z8PLe-BACMG-tedzn-ON0yi';
    //         $decode = json_decode($config->provider_payment, true)['tripay'];
    //         $merchantCode = $decode['merchant_code'];
    //         $apiKey = $decode['api_key'];
    //         $privateKey = $decode['merchant_code'];
    //         $client = new TriPayClient($merchantCode, $apiKey, $privateKey, 'development');

    //         $callback = new Callback($client);

    //         $callback->enableDebug();
    //         try {
    //             $callback->validate();
    //         } catch (Exception $e) {
    //             echo $e->getMessage();
    //             die;
    //         }
    //         $data = (array) $callback->data();
    //         // dd($data);
    //         $invoiceId = addslashes($data['merchant_ref']);
    //         $status = strtoupper((string) $data['status']);

    //         if ($data['is_closed_payment'] === 1) {
    //             // $result = $checkout->getInvoiceUnpaid($invoiceId);
    //             $result = Deposit::where('process', 'otomatis')->where('status', 'pending')->first();

    //             if (! $result) {
    //                 exit(json_encode([
    //                     'success' => false,
    //                     'message' => 'Invoice not found or already paid: ' . $invoiceId,
    //                 ]));
    //             }

    //             switch ($status) {
    //                 // handle status PAID

    //                 case 'PAID':
    //                     if (! Deposit::where('trxid', $result['merchant_ref'])->update(['status' => 'done'])) {
    //                         return json_encode([
    //                             'success' => false,
    //                             'message' => 'Data gagal diproses 1',
    //                         ]);
    //                     }
    //                     break;

    //                 // handle status EXPIRED
    //                 case 'EXPIRED':
    //                     if (! Deposit::where('trxid', $result['merchant_ref'])->update(['status' => 'canceled'])) {
    //                         return json_encode([
    //                             'success' => false,
    //                             'message' => 'Data gagal diproses 2',
    //                         ]);
    //                     }
    //                     break;

    //                 // handle status FAILED
    //                 case 'FAILED':
    //                     if (! Deposit::where('trxid', $result['merchant_ref'])->update(['status' => 'canceled'])) {
    //                         return json_encode([
    //                             'success' => false,
    //                             'message' => 'Data gagal diproses 3',
    //                         ]);
    //                     }
    //                     break;

    //                 default:
    //                     return json_encode([
    //                         'success' => false,
    //                         'message' => 'Unrecognized payment status',
    //                     ]);
    //             }

    //             return json_encode(['success' => true]);
    //         }
    //     }
    // }
}
