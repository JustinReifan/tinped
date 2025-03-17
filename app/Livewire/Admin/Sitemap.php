<?php

namespace App\Livewire\Admin;

use App\Models\Config;
use Livewire\Component;

class Sitemap extends Component
{
    public $tab = 'kontak';
    public function saveKontak($kontak)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->sitemap, true);
            $decode['kontak'] = $kontak;
            $config->update([
                'sitemap' => json_encode($decode),
            ]);
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Kontak berhasil diupdate.',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan.',
                'type' => 'error',
            ]);
        }
    }
    public function saveContoh($contoh)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->sitemap, true);
            $decode['contoh_pesanan'] = $contoh;
            $config->update([
                'sitemap' => json_encode($decode),
            ]);
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Kontak berhasil diupdate.',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan.',
                'type' => 'error',
            ]);
        }
    }
    public function saveTos($tos)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->sitemap, true);
            $decode['tos'] = $tos;
            $config->update([
                'sitemap' => json_encode($decode),
            ]);
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Kontak berhasil diupdate.',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan.',
                'type' => 'error',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.sitemap');
    }
}
