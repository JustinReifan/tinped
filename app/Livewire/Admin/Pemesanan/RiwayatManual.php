<?php

namespace App\Livewire\Admin\Pemesanan;

use App\Models\History;
use App\Models\LogBalance;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatManual extends Component
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
        foreach ($history as $row) {
            // Status Mapping
            $row->statusData = [
                'class' => match ($row->status) {
                    'pending' => 'warning',
                    'process' => 'info',
                    'done' => 'success',
                    'error' => 'danger',
                    'partial' => 'primary',
                    default => 'secondary',
                },
                'text' => ucfirst($row->status)
            ];

            // Refill Status
            $row->refillStatus = $row->refill == '1'
                ? '<span class="badge bg-success" style="font-size:15px;"><i class="ti ti-checkbox"></i></span>'
                : '<span class="badge bg-danger" style="font-size:15px;"><i class="ti ti-circle-x"></i></span>';

            // Target Processing
            $explode = explode('||', $row->target);
            $row->displayTarget = $explode[1] ?? $row->target;

            // Formatted Date
            $row->formattedDate = tanggal(date('Y-m-d', strtotime($row->created_at))) . ' ' . date('H:i', strtotime($row->created_at));
        }
        return view('livewire.admin.pemesanan.riwayat-manual', compact('history'));
    }
    function format($num)
    {
        return number_format($num, 0, ",", ".");
    }
}
