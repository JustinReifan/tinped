<?php

namespace App\Livewire\User;

use App\Models\Bot as ModelsBot;
use App\Models\BotWhatsapp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Bot extends Component
{
    public $number_whatsapp, $switch_min_whatsapp = 0, $min_whatsapp = 0, $switch_max_whatsapp = 0, $max_whatsapp = 0, $deposit_whatsapp = 0, $tiket_whatsapp = 0;
    public function saveChanges($switch_min, $switch_max, $notif_deposit, $notif_tiket)
    {
        $wa = ModelsBot::where([['user_id', Auth::user()->id], ['type', 'whatsapp']])->first();
        if ($wa) {
            $wa->number = $this->number_whatsapp;
            $wa->switch_min_saldo = $switch_min;
            $wa->switch_max_saldo = $switch_max;
            $wa->switch_deposit = $notif_deposit;
            $wa->switch_tiket = $notif_tiket;
            $wa->value_min_saldo = $this->min_whatsapp;
            $wa->value_max_saldo = $this->max_whatsapp;
            $wa->save();
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Pengaturan berhasil disimpan',
                'type' => 'success'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Bot Whatsapp belum diaktifkan',
                'type' => 'error'
            ]);
        }
    }
    public function change_whatsapp()
    {
        $wa = ModelsBot::where([['user_id', Auth::user()->id], ['type', 'whatsapp']])->first();
        $check = json_decode(checknumber($this->number_whatsapp), true);
        try {
            if ($wa) {
                $wa->number = $this->number_whatsapp;
                $wa->save();
                $this->dispatch('swal:modal', [
                    'title' => 'Berhasil',
                    'text' => 'Nomor Whatsapp berhasil diubah',
                    'type' => 'success'
                ]);
            } else {
                ModelsBot::create([
                    'user_id' => Auth::user()->id,
                    'type' => 'whatsapp',
                    'number' => $this->number_whatsapp,
                    'switch_min_saldo' => '0',
                    'switch_max_saldo' => '0',
                    'value_min_saldo' => '0',
                    'value_max_saldo' => '0',
                    'switch_deposit' => '0',
                    'switch_tiket' => '0',
                    'status' => '1'
                ]);
                $this->dispatch('swal:modal', [
                    'title' => 'Berhasil',
                    'text' => 'Bot Whatsapp berhasil diaktifkan',
                    'type' => 'success'
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Gagal cek nomor',
                'type' => 'error'
            ]);
        }
    }
    public function render()
    {
        $wa = ModelsBot::where([['user_id', Auth::user()->id], ['type', 'whatsapp']])->first();
        if ($wa) {
            $this->switch_min_whatsapp = $wa->switch_min_saldo;
            $this->switch_max_whatsapp = $wa->switch_max_saldo;
            $this->deposit_whatsapp = $wa->switch_deposit;
            $this->tiket_whatsapp = $wa->switch_tiket;
            if (!$this->number_whatsapp) {
                $this->number_whatsapp = $wa->number;
            }
            if ($this->min_whatsapp == '0') {
                $this->min_whatsapp = $wa->value_min_saldo;
            }
            if ($this->max_whatsapp == '0') {
                $this->max_whatsapp = $wa->value_max_saldo;
            }
        }
        return view('livewire.user.bot', compact('wa'));
    }
}
