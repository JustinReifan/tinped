<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10, $search;
    public $edit_id, $name, $username, $email, $whatsapp, $google2fa, $balance, $omzet, $level, $role, $is_referral, $is_mail, $referral, $gender, $zona, $status;
    public function edit($id)
    {
        $user = User::find($id);
        $this->edit_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->whatsapp = $user->whatsapp;
        $this->google2fa = $user->google2fa;
        $this->balance = $user->balance;
        $this->omzet = $user->omzet;
        $this->level = $user->level;
        $this->role = $user->role;
        $this->is_referral = $user->is_referral;
        $this->is_mail = $user->is_mail;
        $this->referral = $user->referral;
        $this->gender = $user->gender;
        $this->zona = $user->zona;
        $this->status = $user->status;
    }
    public function editUsers()
    {
        $user = User::find($this->edit_id);
        if ($user) {
            $user->name = $this->name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->whatsapp = $this->whatsapp;
            $user->google2fa = $this->google2fa;
            $user->balance = $this->balance;
            $user->omzet = $this->omzet;
            $user->level = $this->level;
            $user->role = $this->role;
            $user->is_referral = $this->is_referral;
            $user->is_mail = $this->is_mail;
            $user->referral = $this->referral;
            $user->zona = $this->zona;
            $user->status = $this->status;
            $user->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Success',
                'text' => 'User updated successfully'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'User not found'
            ]);
        }
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Success',
                'text' => 'User deleted successfully'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'User not found'
            ]);
        }
    }
    public function render()
    {
        if ($this->edit_id) {
            return view('livewire.admin.edit-user');
        } else {
            if ($this->search) {
                $this->resetPage();
            }
            $user = User::search($this->search)->orderBy('id', 'desc')->paginate($this->perPage);
            return view('livewire.admin.manage-users', compact('user'));
        }
    }
}
