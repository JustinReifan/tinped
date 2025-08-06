<?php

namespace App\Livewire;

use App\Models\Deposit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DepositTable extends Component
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

    public $delete_id;
    public function dibatalkan($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show-delete-confirmation');
    }
    public function batalDeposit()
    {
        $layanan = Deposit::where('id', $this->delete_id)->where('user_id', Auth::user()->id)->first();
        if ($layanan) {
            $layanan->update([
                'status' => 'canceled'
            ]);
            $this->dispatch('layananDeleted');
        } else {
            $this->dispatch('failedDeleted');
        }
    }
    // public $history = '';
    use WithPagination;

    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $history = Deposit::with('metode')->search($this->search)->where('status', 'like', '%' . $this->status . '%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.deposit-table', [
            'history' => $history
        ]);
    }
}
