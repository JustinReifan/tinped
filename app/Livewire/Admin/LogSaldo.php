<?php

namespace App\Livewire\Admin;

use App\Models\LogBalance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LogSaldo extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $perPage = 10;
    public $kategori = false;
    public function changeKategori($kategori)
    {
        if ($kategori == 'all') {
            $this->kategori = false;
        } else {
            $this->kategori = $kategori;
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $log = LogBalance::search($this->search)->orderBy('id', 'desc')
            ->where('kategori', 'like', '%' . $this->kategori . '%')
            ->Paginate($this->perPage);
        return view('livewire.admin.log-saldo', compact('log'));
    }
}
