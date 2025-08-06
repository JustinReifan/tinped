<?php

namespace App\Livewire\User;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class Berita extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $berita = Announcement::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.user.berita', compact('berita'));
    }
}
