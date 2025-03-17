<?php

namespace App\Livewire\User;

use App\Models\Config;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Pengaturan extends Component
{
    use WithFileUploads;
    public $profile_picture, $gender, $email, $whatsapp, $username, $full_name, $timezone, $new_password, $cpassword, $password;
    public $email2, $number_whatsapp;
    public function changeSetting()
    {
        $this->validate(
            [
                'gender' => 'required',
                'username' => 'required',
                'full_name' => 'required',
                'timezone' => 'required',
                'password' => 'required'
            ],
            [
                'gender.required' => 'Jenis kelamin harus di isi',
                'username.required' => 'Username harus di isi',
                'full_name.required' => 'Nama lengkap harus di isi',
                'timezone.required' => 'Zona waktu harus di isi',
                'password.required' => 'Password harus di isi'
            ]
        );
        $user = User::find(Auth::user()->id);
        $config = Config::first();
        if ($this->profile_picture) {
            $imageName = time() . '.' . $this->profile_picture->extension();
            $tempPath = $this->profile_picture->getRealPath();
            if ($config->path) {
                $destinationPath = $config->path . '/assets/images/user/' . $imageName;
            } else {
                $destinationPath = public_path('assets/images/user/' . $imageName);
            }
            if (File::copy($tempPath, $destinationPath)) {
                File::delete($tempPath);
                $user->image = 'assets/images/user/' . $imageName;
            }
        }
        $user->gender = $this->gender;
        $user->email = $this->email;
        $user->whatsapp = $this->whatsapp;
        $user->username = $this->username;
        $user->name = $this->full_name;
        $user->zona = $this->timezone;
        if ($this->new_password) {
            if ($this->new_password != $this->cpassword) {
                session()->flash('error', 'Password baru tidak sama');
                return;
            } else {
                $user->password = bcrypt($this->new_password);
            }
        }
        if (password_verify($this->password, Auth::user()->password)) {
            $user->save();
            session()->flash('success', 'Data berhasil diubah');
        } else {
            session()->flash('error', 'Password salah');
        }
        $this->reset('password', 'new_password', 'cpassword');
    }
    public function change_email()
    {
        $this->validate(
            [
                'email2' => 'required|email|unique:users,email'
            ],
            [
                'email2.required' => 'Email harus di isi',
                'email2.email' => 'Email tidak valid',
                'email2.unique' => 'Email sudah terdaftar'
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->email = $this->email2;
        $user->save();
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Email berhasil diubah',
            'type' => 'success',
        ]);
        $this->dispatch('removeblock', [
            'refresh' => true
        ]);
    }
    public function refresh()
    {
    }
    public function render()
    {
        // isi semua data yang dibutuhkan
        if (!$this->gender || !$this->email || !$this->whatsapp || !$this->username || !$this->full_name || !$this->timezone) {
            $this->gender = 'female';
            $this->email = Auth::user()->email;
            $this->whatsapp = Auth::user()->whatsapp;
            $this->username = Auth::user()->username;
            $this->full_name = Auth::user()->name;
            $this->timezone = Auth::user()->zona;
        }
        $this->dispatch('removeblock', ['refresh' => false]);
        return view('livewire.user.pengaturan');
    }
}
