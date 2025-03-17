<?php

namespace App\Livewire\Admin\Konfigurasi;

use App\Models\BotConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Bot extends Component
{
    public $tab = 'api_key';
    public function saveApiKey($url, $api_key, $device_key, $api_keys, $device_keys, $target, $message)
    {
        $data = [
            'api_key' => $api_keys,
            'device_key' => $device_keys,
            'target' => $target,
            'message' => $message,
        ];
        $bot = BotConfig::first();
        $bot->update([
            'url' => $url,
            'api_key' => $api_key,
            'device_key' => $device_key,
            'konfigurasi' => json_encode($data),
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Api key berhasil',
            'type' => 'success',
        ]);
    }
    public function saveBatasSaldo($batas_saldo)
    {
        $bot = BotConfig::first();
        $bot->update([
            'batas_saldo' => $batas_saldo,
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Batas saldo berhasil',
            'type' => 'success',
        ]);
    }
    public function saveMaxPesanan($max_pesanan)
    {
        $bot = BotConfig::first();
        $bot->update([
            'max_pesanan' => $max_pesanan,
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Max pesanan berhasil',
            'type' => 'success',
        ]);
    }
    public function saveNotifDeposit($notif_deposit)
    {
        $bot = BotConfig::first();
        $bot->update([
            'notif_deposit' => $notif_deposit,
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Notif deposit berhasil',
            'type' => 'success',
        ]);
    }
    public function saveNotifTiket($notif_tiket)
    {
        $bot = BotConfig::first();
        $bot->update([
            'notif_tiket' => $notif_tiket,
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Notif tiket berhasil',
            'type' => 'success',
        ]);
    }
    public function saveReplyTiket($reply_tiket)
    {
        $bot = BotConfig::first();
        $bot->update([
            'reply_tiket' => $reply_tiket,
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Reply tiket berhasil',
            'type' => 'success',
        ]);
    }
    public function saveForgotPassword($forgot)
    {
        $bot = BotConfig::first();
        $bot->update([
            'forgot_password' => $forgot,
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Forgot password berhasil',
            'type' => 'success',
        ]);
    }
    public function render()
    {

        if (!Schema::hasColumn('bot_configs', 'url')) {
            DB::statement("ALTER TABLE bot_configs ADD COLUMN url VARCHAR(255) NULL after id");
        }
        if (!Schema::hasColumn('bot_configs', 'konfigurasi')) {
            DB::statement("ALTER TABLE bot_configs ADD COLUMN konfigurasi JSON NULL after device_key");
        }
        $bot = BotConfig::first();
        return view('livewire.admin.konfigurasi.bot', compact('bot'));
    }
}
