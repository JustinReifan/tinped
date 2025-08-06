<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class HistoryTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $status = false;
    public function changeStatus($status)
    {
        if ($status == 'all') {
            $this->status = false;
        } else {
            $this->status = $status;
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $history = History::search($this->search)->where('status', 'like', '%' . $this->status . '%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->Paginate($this->perPage);
        return view('livewire.history-table', [
            'history' => $history
        ]);
    }
}
