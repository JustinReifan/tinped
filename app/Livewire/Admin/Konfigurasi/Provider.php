<?php

namespace App\Livewire\Admin\Konfigurasi;

use App\Helpers\Smm as HelpersSmm;
use App\Models\Category;
use App\Models\Config;
use App\Models\Favorit;
use App\Models\MetodePembayaran;
use App\Models\Provider as ModelsProvider;
use App\Models\Smm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class Provider extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $tab = 'provider';
    public $provider, $provider_exchange, $original_text, $replace_text;
    public function ubahStatus($id, $status)
    {
        $provider = ModelsProvider::find($id);

        if ($provider) {
            $provider->status = $status;
            $provider->save();

            Smm::where('provider', $provider->nama)->update(['status' => $status]);

            Favorit::whereIn('service_id', Smm::where('provider', $provider->nama)->pluck('id'))
                ->update(['status' => $status]);
            Category::where('provider', $provider->nama)->update(['status' => $status]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Status provider ' . $provider->nama . ' berhasil diubah'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider tidak ditemukan'
            ]);
        }
    }
    public function ubahAutoDelete($status, $id)
    {
        $provider = ModelsProvider::find($id);

        if ($provider) {
            $provider->auto_delete = $status;
            $provider->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Auto delete provider ' . $provider->nama . ' berhasil diubah'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider tidak ditemukan'
            ]);
        }
    }
    public function addProvider($manual, $nama, $currency, $rate, $sisa_saldo, $status)
    {
        $provider = ModelsProvider::where('nama', $nama)->first();
        if ($provider) {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider ' . $nama . ' sudah ada'
            ]);
        } else {
            if (!Schema::hasColumn('providers', 'proses_manual')) {
                DB::statement("ALTER TABLE providers ADD COLUMN proses_manual enum('0','1') NOT NULL DEFAULT '0' AFTER auto_delete");
            }
            $json = '{"1":{"min":"1","max":"99999","type":"percent","profit":"10"},"2":{"min":"100000","max":"499999","type":"percent","profit":"5"},"3":{"min":"500000","max":"999999","type":"percent","profit":"10"},"4":{"min":"1000000","max":"1000000","type":"percent","profit":"60"}}';
            ModelsProvider::create([
                'proses_manual' => $manual,
                'nama' => $nama,
                'currency' => $currency,
                'rate' => $rate,
                'sisa_saldo' => $sisa_saldo,
                'profit' => $json,
                'replace_text' => '[]',
                'status' => $status
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Provider ' . $nama . ' berhasil ditambahkan'
            ]);
        }
    }
    public function deleteProvider($id)
    {
        $provider = ModelsProvider::find($id);
        if ($provider) {
            $provider->delete();
            $category = Category::where('provider', $provider->nama)->delete();
            $smm = Smm::where('provider', $provider->nama)->delete();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Provider ' . $provider->nama . ' berhasil dihapus'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider tidak ditemukan'
            ]);
        }
    }
    public function cekSaldo($id)
    {
        $provider = ModelsProvider::find($id);
        if ($provider) {
            if ($provider->json) {
                $decode = json_decode($provider->json, true);
                $permintaan = $decode['permintaan']['profile'];
                $data = [];
                $data[$permintaan['provider_key']] = $decode['provider_key'];
                if ($permintaan['provider_id'] != null) {
                    $data[$permintaan['provider_id']] = $decode['provider_id'];
                }
                if ($permintaan['provider_secret'] != null) {
                    $data[$permintaan['provider_secret']] = $decode['provider_secret'];
                }
                if ($permintaan['action'] != null) {
                    $data['action'] = $permintaan['action'];
                }
                $cek = new HelpersSmm($provider->nama);
                $cek = $cek->profile($data);

                if ($cek) {
                    if (isset($cek['error'])) {
                        $this->dispatch('swal:modal', [
                            'type' => 'error',
                            'title' => 'Gagal',
                            'text' => $cek['error']
                        ]);
                        return;
                    }

                    $dataresponse = $decode['response']['profile']['balance'];
                    $validate = json_decode(getValueByPath($cek, $dataresponse));
                    if ($validate->status == true) {
                        $provider->balance = $validate->data;
                        $provider->save();
                        $this->dispatch('swal:modal', [
                            'type' => 'success',
                            'title' => 'Berhasil',
                            'text' => 'Saldo ' . $provider->nama . ' berhasil diambil'
                        ]);
                    } else {
                        $this->dispatch('swal:modal', [
                            'type' => 'error',
                            'title' => 'Gagal',
                            'text' => $validate->data
                        ]);
                    }
                } else {
                    $this->dispatch('swal:modal', [
                        'type' => 'error',
                        'title' => 'Gagal',
                        'text' => 'Gagal mengambil saldo'
                    ]);
                }
            } else {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Database provider tidak ditemukan, silahkan atur database provider'
                ]);
            }
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider tidak ditemukan'
            ]);
        }
    }
    public function addReplace()
    {
        $provider = ModelsProvider::find($this->provider_exchange);
        if ($provider) {
            $replace = json_decode($provider->replace_text, true);
            $status = false;
            foreach ($replace as $cek) {
                if ($cek['text'] == $this->original_text) {
                    $status = true;
                }
            }
            if ($status) {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Replace text sudah ada',
                ]);
                return;
            }
            $data = [
                'text' => $this->original_text,
                'replace' => $this->replace_text
            ];
            array_push($replace, $data);
            $provider->replace_text = json_encode($replace);
            $provider->save();
            $this->reset('original_text', 'replace_text');
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Replace text berhasil ditambah',
                'refresh' => true,
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider tidak ditemukan',
            ]);
        }
    }
    public function deleteReplace($key)
    {
        $provider = ModelsProvider::find($this->provider_exchange);
        if ($provider) {
            $replace = json_decode($provider->replace_text, true);
            unset($replace[$key]);
            $provider->replace_text = json_encode(array_values($replace));
            $provider->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Replace berhasil dihapus',
                'refresh' => true,
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Provider tidak ditemukan',
            ]);
        }
    }
    public function render()
    {
        $providers = ModelsProvider::orderBy('id', 'desc')->paginate($this->perPage);
        if (!Schema::hasColumn('providers', 'auto_delete')) {
            DB::statement("ALTER TABLE providers ADD COLUMN auto_delete enum('0','1') NOT NULL DEFAULT '1' AFTER replace_text");
        }
        if (!Schema::hasColumn('providers', 'auto_nologin')) {
            DB::statement("ALTER TABLE providers ADD COLUMN auto_nologin enum('0','1') NOT NULL DEFAULT '0' AFTER auto_delete");
        }
        if (!Schema::hasColumn('providers', 'proses_manual')) {
            DB::statement("ALTER TABLE providers ADD COLUMN proses_manual enum('0','1') NOT NULL DEFAULT '0' AFTER auto_delete");
        }
        return view('livewire.admin.konfigurasi.provider', compact('providers'));
    }
}
