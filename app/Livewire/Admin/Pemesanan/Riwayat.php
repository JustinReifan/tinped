<?php

namespace App\Livewire\Admin\Pemesanan;

use App\Models\History;
use App\Models\LogBalance;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Riwayat extends Component
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
        $history = History::find($id);
        if ($history) {
            if ($status == 'refund' or $status == 'error') {
                $user = User::find($history->user_id);

                if ($user) {
                    LogBalance::create([
                        'user_id' => $history->user_id,
                        'kategori' => 'refund',
                        'jumlah' => $history->price,
                        'before_balance' => $user->balance,
                        'after_balance' => $user->balance + $history->price,
                        'description' => 'Refund Order #' . $history->trxid . ' dengan jumlah Rp ' . $this->format($history->price),
                    ]);
                    $user->balance = $user->balance + $history->price;
                    $user->save();
                }
            }
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

        $history = History::with('user', 'providers')
            ->Admin($this->search)
            ->where('status', 'like', '%' . $this->status . '%')
            ->orderByDesc('id')
            ->paginate($this->perPage);
        return view('livewire.admin.pemesanan.riwayat', compact('history'));
    }
}
