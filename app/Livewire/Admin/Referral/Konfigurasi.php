<?php

namespace App\Livewire\Admin\Referral;

use App\Models\Config;
use App\Models\ConfigReferral;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Konfigurasi extends Component
{
    public $level, $type_komisi, $value;
    public function store()
    {
        $konfigurasi = ConfigReferral::where('level', $this->level)->first();
        if ($konfigurasi) {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Konfigurasi sudah ada',
            ]);
        } else {
            ConfigReferral::create([
                'level' => $this->level,
                'type_komisi' => $this->type_komisi,
                'value' => $this->value
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Konfigurasi berhasil ditambahkan',
            ]);
            $this->reset('level', 'type_komisi', 'value');
        }
    }
    public function deleteConfig($id)
    {
        $konfigurasi = ConfigReferral::find($id);
        $konfigurasi->delete();
        $this->dispatch('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Konfigurasi berhasil dihapus',
        ]);
    }
    public function setRate($rate)
    {
        $config = Config::first();
        $config->update([
            'rate_withdraw' => $rate
        ]);
        $this->dispatch('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Rate withdraw berhasil diupdate',
        ]);
    }
    public function setTos($tos)
    {
        $config = Config::first();
        $config->tos_referral = $tos;
        $config->save();
        $this->dispatch('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'TOS berhasil diupdate',
        ]);
    }
    public function render()
    {
        $konfigurasi = ConfigReferral::orderBy('id', 'desc')->paginate(10);
        if (!Schema::hasColumn('configs', 'tos_referral')) {
            DB::statement("ALTER TABLE configs ADD COLUMN tos_referral TEXT NULL AFTER path");
        }
        return view('livewire.admin.referral.konfigurasi', compact('konfigurasi'));
    }
}
