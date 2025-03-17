<?php

namespace App\Livewire;

use App\Models\Favorit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;

class FavoritTable extends Component
{
    public $perPage = 10;
    public $search = '';
    public $status = false;
    // public $history = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delete_id;
    public function  deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show-delete-confirmation');
    }
    public function deleteLayanan()
    {
        $layanan = Favorit::where('id', $this->delete_id)->where('user_id', Auth::user()->id)->first();
        if ($layanan) {
            $layanan->delete();
            $this->dispatch('layananDeleted');
        } else {
            $this->dispatch('failedDeleted');
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $history = Favorit::search($this->search)
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.favorit-table', [
            'history' => $history
        ]);
    }
}
