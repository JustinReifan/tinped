<?php

namespace App\Livewire\Admin;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tiket extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $status = false;
    public $ticket_id = false;
    protected $listeners = ['closeTicket' => 'closeTickets'];
    public function changeStatus($status)
    {
        if ($status == 'all') {
            $this->status = false;
            return;
        }
        $this->status = $status;
    }
    public function closeTicket($id)
    {
        $this->ticket_id = $id;
        $this->dispatch('show-closed-confirmation');
    }
    public function closeTickets()
    {
        $layanan = Ticket::where('id', $this->ticket_id)->first();
        if ($layanan) {
            $layanan->update([
                'status' => 'closed'
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Tiket berhasil ditutup'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Tiket gagal ditutup'
            ]);
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $history = Ticket::search($this->search)->with('user')->where('status', 'like', '%' . $this->status . '%')
            ->orderBy('id', 'desc')
            ->Paginate($this->perPage);
        return view('livewire.admin.tiket', compact('history'));
    }
}
