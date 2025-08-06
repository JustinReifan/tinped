<?php

namespace App\Livewire\Admin;

use App\Models\Announcement;
use Livewire\Component;

class TambahBerita extends Component
{
    public function addBerita($type, $message)
    {
        Announcement::create([
            'type' => $type,
            'message' => $message,
        ]);
        $this->dispatch('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Berita berhasil ditambahkan',
        ]);
    }
    public function render()
    {
        return view('livewire.admin.tambah-berita');
    }
}
