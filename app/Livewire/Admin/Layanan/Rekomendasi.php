<?php

namespace App\Livewire\Admin\Layanan;

use App\Models\Config;
use App\Models\Smm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Rekomendasi extends Component
{
    public function deleteRekomendasi($id, $provider)
    {
        $config = Config::first();
        if ($config) {
            $teks = $id . '||' . $provider;
            $pairs = explode(',', $config->layanan_rekomendasi);

            $indexToRemove = null;
            foreach ($pairs as $i => $pair) {
                list($pairId, $pairProvider) = explode('||', $pair);
                if ($pairId == $id && $pairProvider == $provider) {
                    $indexToRemove = $i;
                    break;
                }
            }

            if ($indexToRemove !== null) {
                unset($pairs[$indexToRemove]);
                $newLayananRekomendasi = implode(',', $pairs);
                if (empty($newLayananRekomendasi)) {
                    $newLayananRekomendasi = '';
                }

                $config->update([
                    'layanan_rekomendasi' => $newLayananRekomendasi,
                ]);

                $this->dispatch('swal:modal', [
                    'title' => 'Berhasil',
                    'text' => 'Layanan berhasil dihapus dari rekomendasi.',
                    'type' => 'success',
                ]);
            } else {
                $this->dispatch('swal:modal', [
                    'title' => 'Gagal',
                    'text' => 'Data tidak ditemukan.',
                    'type' => 'error',
                ]);
            }
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan.',
                'type' => 'error',
            ]);
        }
    }
    public function tambah($id, $provider)
    {
        $config = Config::first();
        if ($config) {
            $cek = Smm::where([['provider', $provider], ['service', $id]])->first();
            if (!$cek) {
                $this->dispatch('swal:modal', [
                    'title' => 'Gagal',
                    'text' => 'Data tidak ditemukan.',
                    'type' => 'error',
                ]);
                return;
            }
            if (strpos($config->layanan_rekomendasi, $id) === false) {
                if ($config->layanan_rekomendasi) {
                    $layanan = $config->layanan_rekomendasi . ',' . $id . '||' . $provider;
                } else {
                    $layanan = $id . '||' . $provider;
                }
                $config->update([
                    'layanan_rekomendasi' => $layanan,
                ]);
                $this->dispatch('swal:modal', [
                    'title' => 'Berhasil',
                    'text' => 'Layanan berhasil ditambahkan ke rekomendasi.',
                    'type' => 'success',
                ]);
            } else {
                $this->dispatch('swal:modal', [
                    'title' => 'Gagal',
                    'text' => 'Layanan sudah ada di rekomendasi.',
                    'type' => 'error',
                ]);
            }
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
        $config = Config::first();
        if ($config) {
            if (strpos($config->layanan_rekomendasi, '||') === false) {
                $config->layanan_rekomendasi = '';
                $config->save();
            }
        }
        return view('livewire.admin.layanan.rekomendasi');
    }
}
