<?php

namespace App\Livewire\Admin;

use App\Models\Config;
use App\Models\Landing;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class LandingPage extends Component
{
    use WithFileUploads;
    public $tab = 'page-1';
    public $image_pagefour;
    public function savePage1($header, $header2, $rating, $count, $order)
    {
        $landing = Landing::first();
        $landing->update([
            'page_one' => json_encode([
                'header' => $header,
                'header2' => $header2,
                'rating' => $rating,
                'count_member' => $count,
                'order' => $order
            ])
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Success',
            'text' => 'Data berhasil diupdate',
            'type' => 'success',
        ]);
    }
    public function deletePeople($key)
    {
        $landing = Landing::first();
        $page4 = json_decode($landing->page_four, true);
        unset($page4['data'][$key]);
        $landing->update([
            'page_four' => json_encode($page4)
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Success',
            'text' => 'Data berhasil dihapus',
            'type' => 'success',
        ]);
    }
    public function savePeople($nama, $content, $profesi)
    {
        $config = Config::first();
        $landing = Landing::first();
        $page4 = json_decode($landing->page_four, true);
        if ($this->image_pagefour) {
            $imageName = time() . '.' . $this->image_pagefour->extension();
            $tempPath = $this->image_pagefour->getRealPath();
            if ($config->path) {
                $destinationPath = $config->path . '/assets/images/' . $imageName;
            } else {
                $destinationPath = public_path('assets/images/' . $imageName);
            }
            if (File::copy($tempPath, $destinationPath)) {
                File::delete($tempPath);
                $image = 'assets/images/' . $imageName;
            }
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Error',
                'text' => 'Gambar tidak boleh kosong',
                'type' => 'error',
            ]);
        }
        $page4['data'][] = [
            'nama' => $nama,
            'image' => $image,
            'content' => $content,
            'profesi' => $profesi
        ];
        $landing->update([
            'page_four' => json_encode($page4)
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Success',
            'text' => 'Data berhasil ditambahkan',
            'type' => 'success',
        ]);
    }
    public function saveFooter($footer)
    {
        $landing = Landing::first();
        $landing->update([
            'footer' => $footer
        ]);
        $this->dispatch('swal:modal', [
            'title' => 'Success',
            'text' => 'Data berhasil diupdate',
            'type' => 'success',
        ]);
    }
    public function savePage4($title, $small_text)
    {
        $landing = Landing::first();
        if ($landing) {
            $decode = json_decode($landing->page_four, true);
            $decode['title'] = $title;
            $decode['small_text'] = $small_text;
            $landing->update([
                'page_four' => json_encode($decode),
            ]);
            $this->dispatch('swal:modal', [
                'title' => 'Success',
                'text' => 'Data berhasil diupdate',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Error',
                'text' => 'Data tidak ditemukan',
                'type' => 'error',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.landing-page');
    }
}
