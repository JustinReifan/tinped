<?php

namespace App\Livewire\Admin\Konfigurasi;

use App\Models\Config;
use App\Models\MetodePembayaran;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads as LivewireWithFileUploads;

class Payment extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10, $search;
    public $tab = 'database', $provider, $type_payment, $metod, $provider_payment, $image_metode;
    public $min_nominal, $bonus;
    public $edit_id, $provider2, $type_proses, $code, $name, $rate_type, $rate, $account_name, $account_number, $min_deposit, $max_deposit, $nologin, $status;
    public $api_key, $private_key;
    public function deleteBonus($key)
    {
        $metode = MetodePembayaran::find($this->metod);
        if ($metode) {
            $bonus = json_decode($metode->bonus, true);
            unset($bonus[$key]);
            $metode->bonus = json_encode(array_values($bonus));
            $metode->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Bonus berhasil dihapus',
                'refresh' => true,
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Metode pembayaran tidak ditemukan',
            ]);
        }
    }
    public function addbonus()
    {
        $metode = MetodePembayaran::find($this->metod);
        if ($metode) {
            $bonus = json_decode($metode->bonus, true);
            $status = false;
            foreach ($bonus as $cek) {
                if ($cek['min_nominal'] == $this->min_nominal) {
                    $status = true;
                }
            }
            if ($status) {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Bonus sudah ada',
                ]);
                return;
            }
            $data = [
                'min_nominal' => $this->min_nominal,
                'nominal' => $this->bonus
            ];
            array_push($bonus, $data);
            $metode->bonus = json_encode($bonus);
            $metode->save();
            $this->reset('min_nominal', 'bonus');
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Bonus berhasil ditambah',
                'refresh' => true,
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Metode pembayaran tidak ditemukan',
            ]);
        }
    }
    public function addMetode($provider,  $type_payment, $code,  $name, $rate_type, $rate, $account_name, $account_number, $min_deposit, $max_deposit, $type_proses)
    {
        $metode = MetodePembayaran::where('code', $code)->first();
        if ($metode) {
            session()->flash('error', 'Metode pembayaran sudah ada');
            return;
        }
        if ($this->image_metode == null) {
            session()->flash('error', 'Logo metode pembayaran wajib diisi');
            return;
        }
        $config = Config::first();
        $imageName = time() . '.' . $this->image_metode->extension();
        $tempPath = $this->image_metode->getRealPath();
        if ($config->path) {
            $destinationPath = $config->path . '/assets/images/payment/' . $imageName;
        } else {
            $destinationPath = public_path('assets/images/payment/' . $imageName);
        }
        if (File::copy($tempPath, $destinationPath)) {
            File::delete($tempPath);
            $img = 'assets/images/payment/' . $imageName;
        }
        MetodePembayaran::create([
            'provider' => $provider,
            'type_payment' => $type_payment,
            'type_proses' => $type_proses,
            'code' => $code,
            'name' => $name,
            'rate_type' => $rate_type,
            'rate' => $rate,
            'bonus' => '[]',
            'min_nominal' => $min_deposit,
            'max_nominal' => $max_deposit,
            'image' => $img,
            'account_number' => $account_number,
            'account_name' => $account_name,
            'description' => '',
            'status' => 'active',
        ]);
        $this->reset('image_metode');
        session()->flash('success', 'Metode pembayaran berhasil ditambah');
        $this->dispatch('resetform');
    }
    public function delete($id)
    {
        $metod = MetodePembayaran::find($id);
        if ($metod) {
            $metod->delete();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Metode pembayaran berhasil dihapus',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Metode pembayaran tidak ditemukan',
            ]);
        }
    }
    public function edit($id)
    {
        $metod = MetodePembayaran::find($id);
        if ($metod) {
            $this->image_metode = null;
            $this->edit_id = $metod->id;
            $this->provider2 = $metod->provider;
            $this->code = $metod->code;
            $this->name = $metod->name;
            $this->rate = $metod->rate;
            $this->min_deposit = $metod->min_nominal;
            $this->max_deposit = $metod->max_nominal;
            $this->rate_type = $metod->rate_type;
            $this->account_number = $metod->account_number;
            $this->account_name = $metod->account_name;
            $this->nologin = $metod->nologin;
            $this->type_proses = $metod->type_proses;
            $this->status = $metod->status;
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Metode pembayaran tidak ditemukan',
            ]);
        }
    }
    public function SaveEdit()
    {
        $config = Config::first();
        $metod = MetodePembayaran::find($this->edit_id);
        if ($metod) {
            if ($this->image_metode) {
                $imageName = time() . '.' . $this->image_metode->extension();
                $tempPath = $this->image_metode->getRealPath();
                if ($config->path) {
                    $destinationPath = $config->path . '/assets/images/payment/' . $imageName;
                } else {
                    $destinationPath = public_path('assets/images/payment/' . $imageName);
                }
                if (File::copy($tempPath, $destinationPath)) {
                    File::delete($tempPath);
                    $img = 'assets/images/payment/' . $imageName;
                }
            } else {
                $img = $metod->image;
            }
            $metod->update([
                'provider' => $this->provider2,
                'code' => $this->code,
                'name' => $this->name,
                'rate' => $this->rate,
                'image' => $img,
                'rate_type' => $this->rate_type,
                'min_nominal' => $this->min_deposit,
                'max_nominal' => $this->max_deposit,
                'account_number' => $this->account_number,
                'account_name' => $this->account_name,
                'nologin' => $this->nologin,
                'type_proses' => $this->type_proses,
                'status' => $this->status,
            ]);
            $this->reset('image_metode', 'edit_id');
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Metode pembayaran berhasil diubah',

            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Metode pembayaran tidak ditemukan',
            ]);
        }
    }
    public function saveProvider($api_key, $private_key, $api_id, $merchant_id, $merchant_code)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->provider_payment, true);
            $cek = array_key_exists($this->provider_payment, $decode);
            if ($cek) {
                $decode[$this->provider_payment] = [
                    'api_key' => $api_key,
                ];
                if (isset($private_key)) {
                    $decode[$this->provider_payment]['private_key'] = $private_key;
                }
                if (isset($api_id)) {
                    $decode[$this->provider_payment]['api_id'] = $api_id;
                }
                if (isset($merchant_id)) {
                    $decode[$this->provider_payment]['merchant_id'] = $merchant_id;
                }
                if (isset($merchant_code)) {
                    $decode[$this->provider_payment]['merchant_code'] = $merchant_code;
                }
                $config->provider_payment = json_encode($decode);
                $config->save();
                $this->dispatch('swal:modal', [
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'text' => 'Config berhasil diubah',
                ]);
            } else {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Config tidak ditemukan',
                ]);
            }
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Config tidak ditemukan',
            ]);
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        if ($this->edit_id) {
            return view('livewire.admin.konfigurasi.payment-edit');
        } else {
            $metode = MetodePembayaran::search($this->search)->where([['provider', 'like', '%' . $this->provider . '%'], ['type_payment', 'like', '%' . $this->type_payment . '%']])->orderBy('id', 'desc')->paginate($this->perPage);
            return view('livewire.admin.konfigurasi.payment', compact('metode'));
        }
    }
}
