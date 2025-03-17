<?php

namespace App\Livewire\Admin\Layanan;

use App\Models\Category;
use App\Models\Smm;
use Livewire\Component;
use Livewire\WithPagination;

class Konfigurasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category = false;
    public $tab = 'database', $perPage = 10, $search, $custom;
    public $edit_id, $provider, $service_id, $category2, $name, $price, $min, $type, $max, $description, $refill,  $average_time, $status;
    public function changeType($type)
    {
        if ($type == 'all') {
            $this->custom = false;
        } else {
            $this->custom = $type;
        }
    }
    public function editProduct($id)
    {
        $smm = Smm::find($id);
        if ($smm) {
            $this->edit_id = $id;
            $this->provider = $smm->provider;
            $this->service_id = $smm->service;
            $this->category2 = $smm->category;
            $this->name = $smm->name;
            $this->price = $smm->price;
            $this->type = $smm->type;
            $this->min = $smm->min;
            $this->max = $smm->max;
            $this->description = $smm->description;
            $this->average_time = $smm->average_time;
            $this->status = $smm->status;
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Layanan tidak ditemukan'
            ]);
        }
    }
    public function deleteLayanan($id)
    {
        $smm = Smm::find($id);
        if ($smm) {
            $smm->delete();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Layanan berhasil dihapus'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Layanan tidak ditemukan'
            ]);
        }
    }
    public function editProducts()
    {
        $smm = Smm::find($this->edit_id);
        if ($smm) {
            $smm->provider = $this->provider;
            $smm->service = $this->service_id;
            $smm->category = $this->category2;
            $smm->name = $this->name;
            $smm->price = $this->price;
            $smm->type = $this->type;
            $smm->min = $this->min;
            $smm->max = $this->max;
            $smm->description = $this->description;
            $smm->average_time = $this->average_time;
            $smm->save();
            $this->reset('edit_id', 'provider', 'service_id', 'category', 'name', 'price', 'type', 'min', 'max', 'description', 'average_time', 'status');
            $this->dispatch('closeModal');
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Layanan berhasil diubah'
            ]);
            return;
        } else {
            $this->dispatch('closeModal');
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Layanan tidak ditemukan'
            ]);
            return;
        }
    }
    public function savednews()
    {
        $this->validate(
            [
                'provider' => 'required',
                'service_id' => 'required|numeric',
                'category2' => 'required',
                'name' => 'required',
                'price' => 'required',
                'min' => 'required',
                'type' => 'required',
                'max' => 'required',
                'refill' => 'required',
                'description' => 'required',
            ],
            [
                'provider.required' => 'Provider tidak boleh kosong',
                'service_id.required' => 'Service ID tidak boleh kosong',
                'service_id.numeric' => 'Service ID harus berupa angka',
                'category.required' => 'Kategori tidak boleh kosong',
                'name.required' => 'Nama tidak boleh kosong',
                'price.required' => 'Harga tidak boleh kosong',
                'min.required' => 'Min tidak boleh kosong',
                'type.required' => 'Type tidak boleh kosong',
                'max.required' => 'Max tidak boleh kosong',
                'refill.required' => 'Refill tidak boleh kosong',
                'description.required' => 'Deskripsi tidak boleh kosong',
            ]
        );
        $layanan = Smm::where('name', $this->name)->first();
        if ($layanan) {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Layanan sudah ada'
            ]);
        } else {
            $service = Smm::where([['service', $this->service_id], ['provider', $this->provider]])->first();
            if ($service) {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Service sudah ada'
                ]);
                return;
            }
            $data = [
                'provider' => $this->provider,
                'service' => $this->service_id,
                'type' => $this->type,
                'category' => $this->category2,
                'name' => $this->name,
                'price' => $this->price,
                'min' => $this->min,
                'max' => $this->max,
                'refill' => $this->refill,
                'description' => $this->description,
                'average_time' => $this->average_time,
                'status' => 'aktif',
            ];
            Smm::create($data);
            $this->reset('provider', 'service_id', 'category', 'name', 'price', 'min', 'type', 'max', 'description');
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Layanan berhasil ditambahkan'
            ]);
        }
    }
    public function render()
    {
        $query = Smm::query();

        if ($this->search) {
            $query = Smm::search($this->search, $query); // Pass the query to your custom search method
        }

        $layanan = $query->where('type', 'like', "%{$this->custom}%")
            ->where('category', 'like', "%{$this->category}%")
            ->orderByDesc('id')
            ->paginate($this->perPage);

        $kategori = Category::orderBy('kategori')->get();
        return view('livewire.admin.layanan.konfigurasi', compact('layanan', 'kategori'));
    }
}
