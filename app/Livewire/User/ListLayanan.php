<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Smm;
use Livewire\Component;
use Livewire\WithPagination;

class ListLayanan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $kate;
    public $perPage = 10;
    public $search = '';
    public $custom = false;
    public $category = false;
    public function changeCustom($custom)
    {
        if ($custom == 'all') {
            $this->custom = false;
        } else {
            $this->custom = $custom;
        }
    }
    public function Categorys($category)
    {
        $this->category = $category;
    }
    public function render()
    {
        if ($this->search) {
            $this->resetPage();
        }
        if ($this->category == null) {
            $layanan = Smm::with('kategori')->search($this->search)
                ->where('category', 'like', '%' . $this->kate . '%')
                ->where('type', 'like', '%' . $this->custom . '%')
                ->paginate($this->perPage);
        } else {
            $this->resetPage();
            $layanan = Smm::with('kategori')->search($this->search)
                ->where('category', $this->category ?? false)
                ->where('type', 'like', '%' . $this->custom . '%')
                ->paginate($this->perPage);
        }
        $kategori = Category::where('kategori', 'like', '%' . $this->kate . '%')->where('status', 'aktif')->orderBy('kategori', 'asc')->get();
        return view('livewire.user.list-layanan', compact('layanan', 'kategori'));
    }
}