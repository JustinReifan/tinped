<?php

namespace App\Livewire;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TicketTable extends Component
{
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
    // public $history = '';
    use WithPagination;

    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $history = Ticket::search($this->search)->where('status', 'like', '%' . $this->status . '%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->Paginate($this->perPage);
        return view('livewire.ticket-table', compact('history'));
    }
}
