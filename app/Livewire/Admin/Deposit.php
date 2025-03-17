<?php

namespace App\Livewire\Admin;

use App\Models\Deposit as ModelsDeposit;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LogBalance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Deposit extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $status = false;
    public $type = false;
    public $delete_id, $deposit_id;
    public $toggleEdit = false;
    public $trxid, $type_proses, $code, $name_payment, $account_number, $account_name, $amount, $diterima;
    public $paginationTheme = 'bootstrap';

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
        $deposit = ModelsDeposit::find($id);
        if ($deposit) {
            $this->dispatch('swal:confirm', [
                'type' => 'warning',
                'title' => 'Apakah anda yakin?',
                'text' => 'Status deposit akan diubah',
                'status' => $status,
                'array' => 'ubahStatuss',
                'id' => $id
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Status deposit gagal diubah'
            ]);
        }
    }
    public function ubahStatuss($status, $id)
    {
        $deposit = ModelsDeposit::where('id', $id)->first();
        if ($deposit) {
            $deposit->update([
                'status' => $status
            ]);
            if ($status == 'done') {
                $user = User::find($deposit->user_id);
                if ($user) {
                    $total = $user->balance + $deposit->diterima;
                    LogBalance::create([
                        'user_id' => $user->id,
                        'type' => 'debit',
                        'kategori' => 'deposit',
                        'jumlah' => $deposit->diterima,
                        'before_balance' => $user->balance,
                        'after_balance' => $total,
                        'description' => 'Deposit saldo berhasil via ' . $deposit->code . ' ' . $deposit->name_payment . ' Sebesar Rp ' . number_format($deposit->diterima, 0, ',', '.') . ''
                    ]);
                    // number format
                    $user->balance = $user->balance + $deposit->diterima;
                    $user->save();
                }
            }
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Status deposit berhasil diubah'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Status deposit gagal diubah'
            ]);
        }
    }
    public function konfirmasi($id)
    {
        $history = ModelsDeposit::where('id', $id)->first();
        if ($history) {
            $history->update([
                'status' => 'done'
            ]);
            // dd($history->diterima);
            $user = User::where('id', $history->user_id)->first();
            $user->balance = $user->balance + $history->diterima;
            $user->save();
            LogBalance::create([
                'user_id' => $user->id,
                'type' => 'Debit',
                'kategori' => 'deposit',
                'jumlah' => $history->diterima,
                'before_balance' => $user->balance - $history->diterima,
                'after_balance' => $user->balance,
                'description' => 'Deposit saldo berhasil via ' . $history->code . ' ' . $history->name_payment
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Deposit berhasil dikonfirmasi'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Deposit gagal dikonfirmasi'
            ]);
        }
    }
    public function batalkan($id)
    {
        $history = ModelsDeposit::where('id', $id)->first();
        if ($history) {
            $history->update([
                'status' => 'canceled'
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Deposit berhasil dibatalkan'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Deposit gagal dibatalkan'
            ]);
        }
    }
    public function updateDeposit()
    {
        $history = ModelsDeposit::where('trxid', $this->trxid)->first();
        if ($history) {
            $history->update([
                'process' => $this->type_proses,
                'code' => $this->code,
                'name_payment' => $this->name_payment,
                'account_number' => $this->account_number,
                'account_name' => $this->account_name,
                'amount' => $this->amount,
                'diterima' => $this->diterima
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Deposit berhasil diupdate'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Deposit gagal diupdate'
            ]);
        }
    }
    public function EditDeposit($id)
    {
        $history = ModelsDeposit::find($id);
        if ($history) {
            $this->deposit_id = $id;
            $this->trxid = $history->trxid;
            $this->type_proses = $history->process;
            $this->code = $history->code;
            $this->account_number = $history->account_number;
            $this->account_name = $history->account_name;
            $this->name_payment = $history->name_payment;
            $this->amount = $history->amount;
            $this->diterima = $history->diterima;
            $this->toggleEdit = true;
        }
    }
    public function render()
    {
        if ($this->toggleEdit) {
            $history = ModelsDeposit::find($this->deposit_id);
            return view('livewire.admin.deposit-edit', compact('history'));
        } else {
            if ($this->search) {
                $this->resetPage();
            }
            $history = ModelsDeposit::search($this->search)->with('user')->where('status', 'like', '%' . $this->status . '%')
                ->orderBy('id', 'desc')
                ->where('process', 'like', '%' . $this->type . '%')
                ->Paginate($this->perPage);
            return view('livewire.admin.deposit', compact('history'));
        }
    }
}
