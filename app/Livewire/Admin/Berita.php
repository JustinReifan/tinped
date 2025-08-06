<?php

namespace App\Livewire\Admin;

use App\Models\Announcement;
use Livewire\Component;

class Berita extends Component
{
    public $perPage = 10, $search;
    public function deleteBerita($id)
    {
        $berita = Announcement::find($id);
        if ($berita) {
            $berita->delete();
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Berita berhasil dihapus.',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Berita tidak ditemukan.',
                'type' => 'error',
            ]);
        }
    }
    public function render()
    {
        $berita = Announcement::orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.admin.berita', compact('berita'));
    }
}
