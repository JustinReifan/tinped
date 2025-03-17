<?php

namespace App\Livewire\Admin;

use App\Models\HistoryOrder;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatNonLogin extends Component
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
    public function ubahStatus($status, $id)
    {
        $history = HistoryOrder::find($id);
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
    public function ubahStatusPembayaran($status, $id)
    {
        $history = HistoryOrder::find($id);
        if ($history) {
            $history->status_payment = $status;
            $history->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Status pembayaran berhasil diubah'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Status pembayaran gagal diubah'
            ]);
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $history = HistoryOrder::searhAdmin($this->search)->where('status', 'like', '%' . $this->status . '%')
            ->orderBy('id', 'desc')
            ->Paginate($this->perPage);
        return view('livewire.admin.riwayat-non-login', compact('history'));
    }
}
