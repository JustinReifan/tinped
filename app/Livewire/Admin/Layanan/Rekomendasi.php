<?php

namespace App\Livewire\Admin\Layanan;

use App\Models\Smm;
use App\Models\Config;
use Livewire\Component;
use App\Models\Category;
use App\Helpers\Encryption;
use App\Models\LayananRekomendasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\KategoriLayananRekomendasi;

class Rekomendasi extends Component
{

    public function deleteRekomendasi($id)
    {
        try {
            // Cari data berdasarkan id DAN provider
            $layanan = LayananRekomendasi::where('id', $id)
                ->first();

            if (!$layanan) {
                $this->dispatch('swal:modal', [
                    'title' => 'Gagal',
                    'text' => 'Data layanan tidak ditemukan ',
                    'type' => 'error',
                ]);
                return;
            }

            $layanan->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Layanan berhasil dihapus dari rekomendasi.',
                'type' => 'success',
            ]);

            // Refresh data setelah delete
            $this->dispatch('refreshData');
        } catch (\Exception $e) {
            $this->dispatch('swal:modal', [
                'title' => 'Error',
                'text' => 'Gagal menghapus layanan: ' . $e->getMessage(),
                'type' => 'error',
            ]);
        }
    }
    public function tambah($idLayanan, $idKategoriRekomendasi)
    {
        $kategoriRekomendasi = KategoriLayananRekomendasi::find($idKategoriRekomendasi);
        if ($kategoriRekomendasi) {
            $decrypt = Encryption::decrypt($idLayanan);
            $explode = explode('|', $decrypt);
            if (count($explode) < 2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Layanan tidak ditemukan'
                ]);
            }
            $service = $explode[0];
            $provider = $explode[1];
            $cek = Smm::where([['provider', $provider], ['service', $service], ['status', 'aktif']])->first();
            if (!$cek) {
                $this->dispatch('swal:modal', [
                    'title' => 'Gagal',
                    'text' => 'Layanan tidak ditemukan.',
                    'type' => 'error',
                ]);
                return;
            }
            if (!$kategoriRekomendasi->layananRekomendasi()->where('service', $service)->where('provider', $provider)->exists()) {

                $kategoriRekomendasi->layananRekomendasi()->create([
                    'kategori_rekomendasi_id' => $kategoriRekomendasi->id,
                    'service' => $service,
                    'provider' => $provider,
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
                'text' => 'Data kategori rekomendasi tidak ditemukan.',
                'type' => 'error',
            ]);
        }
    }
    public function render()
    {
        // Query dengan eager loading dan optimasi
        $layanan_rekomendasi = LayananRekomendasi::query()
            ->with([
                'kategori',
                'smm' => function ($query) {
                    $query->where('status', 'aktif'); // Ambil kolom spesifik
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $kategori_layanan_rekomendasi = KategoriLayananRekomendasi::all();
        $kategori = Category::where('status', 'aktif')->with('smm')->get();
        return view('livewire.admin.layanan.rekomendasi', [
            'kategori' => $kategori,
            'layanan_rekomendasi' => $layanan_rekomendasi,
            'kategori_layanan_rekomendasi' => $kategori_layanan_rekomendasi
        ]);
    }
}
