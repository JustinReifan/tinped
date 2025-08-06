<?php

namespace App\Livewire\Admin\Pemesanan;

use App\Models\HistoryRefill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatRefill extends Component
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
    public function ubahStatus($status, $id)
    {
        $history = HistoryRefill::find($id);
        if ($history) {
            $history->status = $status;
            $history->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Status pemesanan berhasil diubah'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Status pemesanan gagal diubah'
            ]);
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $refill = HistoryRefill::with('user')->Admin($this->search)->where('status', 'like', '%' . $this->status . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.admin.pemesanan.riwayat-refill', compact('refill'));
    }
}
