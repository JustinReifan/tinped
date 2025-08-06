<?php

namespace App\Livewire;

use App\Models\LogMasuk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LogLoginTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $perPage = 10;
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $log = LogMasuk::search($this->search)->where('user_id', Auth::user()->id)->orderBy('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->Paginate($this->perPage);
        return view('livewire.log-login-table', compact('log'));
    }
}
