<?php

namespace App\Livewire\Admin;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $tab = 'database';
    public $perPage = 10, $search;
    public $edit_id, $provider, $service_id, $category, $nologin, $status;
    public function ubahStatus($status, $id)
    {
        $kategori = ModelsCategory::find($id);
        $kategori->update([
            'status' => $status
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Status Berhasil Diubah',
            'type' => 'success',
        ]);
    }
    public function ubahStatusLogin($status, $id)
    {
        $kategori = ModelsCategory::find($id);
        $kategori->update([
            'nologin' => $status
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Status Login Berhasil Diubah',
            'type' => 'success',
        ]);
    }
    public function addCategory($provider, $service_id, $categorys,  $nologin)
    {
        $category = ModelsCategory::where([['provider', $provider], ['kategori', $categorys], ['sid', $service_id]])->first();
        if ($category) {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Kategori sudah ada'
            ]);
        } else {
            $data = [
                'provider' => $provider,
                'kategori' => $categorys,
                'sid' => $service_id,
                'nologin' => $nologin,
            ];
            ModelsCategory::create($data);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Kategori berhasil ditambahkan'
            ]);
        }
    }
    public function deleteCategory($id)
    {
        $kategori = ModelsCategory::find($id);
        if ($kategori) {
            $kategori->delete();
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Kategori Berhasil Dihapus',
                'type' => 'success',
            ]);
        }
    }
    public function edit($id)
    {
        $kategori = ModelsCategory::find($id);
        if ($kategori) {
            $this->edit_id = $kategori->id;
            $this->category = $kategori->kategori;
            $this->provider = $kategori->provider;
            $this->service_id = $kategori->sid;
            $this->nologin = $kategori->nologin;
            $this->status = $kategori->status;
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan',
                'type' => 'error',
            ]);
        }
    }
    public function SaveEdit()
    {
        $kategori = ModelsCategory::find($this->edit_id);
        if ($kategori) {
            $kategori->update([
                'kategori' => $this->category,
                'provider' => $this->provider,
                'sid' => $this->service_id,
                'nologin' => $this->nologin,
                'status' => $this->status,
            ]);
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Kategori Berhasil Diubah',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan',
                'type' => 'error',
            ]);
        }
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        $kategori = ModelsCategory::search($this->search)->orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.admin.category', compact('kategori'));
    }
}
