<?php

namespace App\Livewire\Admin\Pemesanan;

use App\Models\Config;
use Livewire\Component;

class Konfigurasi extends Component
{
    public $tab = 'info';
    public function saveInfo($type, $value)
    {
        $config = Config::first();
        if ($config) {
            if ($type == 'single') {
                $decode = json_decode($config->info_text);
                $decode->single = $value;
                $config->info_text = json_encode($decode);
            } elseif ($type == 'massal') {
                $decode = json_decode($config->info_text);
                $decode->massal = $value;
                $config->info_text = json_encode($decode);
            } else {
                $decode = json_decode($config->info_text);
                $decode->order = $value;
                $config->info_text = json_encode($decode);
            }
            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Konfigurasi berhasil diubah',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Konfigurasi tidak ditemukan',

            ]);
        }
    }
    public function setHidden($status)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->konfigurasi_kategori);
            $decode->kategori_hidden = $status == 'auto' ? true : false;
            $config->konfigurasi_kategori = json_encode($decode);
            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Auto hide kategori berhasil diubah',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Konfigurasi tidak ditemukan',

            ]);
        }
    }
    public function addKategori($nama, $icon)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->konfigurasi_kategori);
            // tambahkan ke list_kategori dengan $nama sebagai key
            $decode->list_kategori->$nama = $icon;
            $config->konfigurasi_kategori = json_encode($decode);

            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Kategori berhasil ditambahkan',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Konfigurasi tidak ditemukan',

            ]);
        }
    }
    public function deleteItem($nama)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->konfigurasi_kategori);
            unset($decode->list_kategori->$nama);
            $config->konfigurasi_kategori = json_encode($decode);

            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Kategori berhasil dihapus',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Konfigurasi tidak ditemukan',

            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.pemesanan.konfigurasi');
    }
}
