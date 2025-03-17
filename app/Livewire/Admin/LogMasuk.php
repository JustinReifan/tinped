<?php

namespace App\Livewire\Admin;

use App\Models\LogMasuk as ModelsLogMasuk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LogMasuk extends Component
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
        $log = ModelsLogMasuk::with('user')->search($this->search)->orderBy('id', 'desc')
            ->Paginate($this->perPage);
        return view('livewire.admin.log-masuk', compact('log'));
    }
}
