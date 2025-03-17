<?php

namespace App\Livewire\Admin\Layanan;

use App\Models\Category;
use App\Models\IconLayanan;
use App\Models\Smm;
use Livewire\Component;
use Livewire\WithPagination;

class Icon extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $checkAll = false, $checkbox = [], $showbutton = false;
    public $tab = 'database', $skip, $perPage = 10, $search;
    public $category, $icon;
    public function edit($id)
    {
        $kategori = Smm::where('service', $id)->first();
        if ($kategori) {
            $this->category = $kategori->category;
            $icon = IconLayanan::where('kategori', 'like', '%' . $this->category . '%')->first();
            if ($icon) {
                $this->icon = $icon->icon;
            }
        } else {
            $this->category = null;
        }
    }
    public function addIcon($icon, $sid)
    {
        $icon = IconLayanan::where('icon', $icon)->first();
        if (!$icon) {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal',
                'text' => 'Icon tidak ditemukan',
                'type' => 'error',
            ]);
        } else {
            foreach ($sid[0] as $row) {
                $kategori = Category::where('sid', $row)->first();
                if ($kategori) {
                    $kategori->icon = $icon->icon;
                    $kategori->save();
                }
            }
            $this->dispatch('swal:modal', [
                'title' => 'Berhasil',
                'text' => 'Icon berhasil diubah',
                'type' => 'success',
            ]);
        }
    }
    public function checkedAll($status)
    {
        if ($status == true) {
            $kategori = Category::search($this->search)->orderBy('id', 'desc')->get();
            $this->checkbox = $kategori->pluck('sid')->map(function ($item) {
                return (string) $item;
            })->toArray();
        } else {
            $this->checkbox = [];
        }
    }
    public function render()
    {
        $this->dispatch('setArray', $this->checkbox);
        if ($this->search) {
            $this->resetPage();
        }
        $kategori = Category::search($this->search)->orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.admin.layanan.icon', compact('kategori'));
    }
}
