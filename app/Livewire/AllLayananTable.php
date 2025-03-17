<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Favorit;
use App\Models\History;
use App\Models\HistoryRefill;
use App\Models\Medans;
use App\Models\Smm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;

class AllLayananTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10, $search;
    public $custom = false, $category = false, $refill = false;
    protected $listeners = ['category' => 'Categorys'];
    public function changeCustom($custom)
    {
        if ($custom == 'all') {
            $this->custom = false;
        } else {
            $this->custom = $custom;
        }
        $this->refill = false;
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
        if ($this->refill) {
            $this->custom = false;
        }
        $layanan = Smm::search($this->search)
            ->where('category', $this->category ?? false)
            ->where('type', 'like', '%' . $this->custom . '%')
            ->where('refill', 'like', '%' . $this->refill . '%')
            ->where('status', 'aktif')
            ->paginate($this->perPage);
        $kategori = Category::where('status', 'aktif')->orderBy('kategori', 'asc')->get();
        return view('livewire.all-layanan-table', compact('layanan', 'kategori'));
    }
}
