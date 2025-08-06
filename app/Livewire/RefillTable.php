<?php

namespace App\Livewire;

use App\Models\HistoryRefill;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RefillTable extends Component
{

    // public $history = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $status = false;
    // handle event click with value
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
        $refill = HistoryRefill::search($this->search)->where('status', 'like', '%' . $this->status . '%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.refill-table', compact('refill'));
    }
}
