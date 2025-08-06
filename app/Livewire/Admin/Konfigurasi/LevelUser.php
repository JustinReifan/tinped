<?php

namespace App\Livewire\Admin\Konfigurasi;

use App\Models\Config;
use App\Models\LevelUser as ModelsLevelUser;
use Livewire\Component;

class LevelUser extends Component
{
    public $tab = 'database';
    public function edit($id, $levels)
    {
        $level = ModelsLevelUser::find($id);
        if ($level) {
            $level->name = $levels;
            $level->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data berhasil diubah',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan',
            ]);
        }
    }
    public function addLevel($levels, $default, $min)
    {
        $level = ModelsLevelUser::where('name', $levels)->first();
        if ($level) {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Level sudah ada',
            ]);
        } else {
            if ($default == '1') {
                $df = ModelsLevelUser::where('default', '1')->first();
                if ($df) {
                    $df->default = '0';
                    $df->save();
                }
            }
            ModelsLevelUser::create([
                'name' => $levels,
                'default' => $default,
                'min_pembelian' => $min,
            ]);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data berhasil ditambahkan',
                'reset' => true,
            ]);
        }
    }
    public function deleteLevel($id)
    {
        $level = ModelsLevelUser::find($id);
        if ($level) {
            $level->delete();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data berhasil dihapus',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan',
            ]);
        }
    }
    public function saveMin($id, $min)
    {
        $level = ModelsLevelUser::find($id);
        if ($level) {
            $level->min_pembelian = $min;
            $level->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data berhasil diubah',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan',
            ]);
        }
    }
    public function setDefault($id)
    {
        $level = ModelsLevelUser::find($id);
        if ($level) {
            $df = ModelsLevelUser::where('default', '1')->first();
            if ($df) {
                $df->default = '0';
                $df->save();
            }
            $level->default = '1';
            $level->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil mengubah level default',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.konfigurasi.level-user');
    }
}
