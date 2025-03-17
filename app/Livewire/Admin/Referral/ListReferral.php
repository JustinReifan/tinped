<?php

namespace App\Livewire\Admin\Referral;

use App\Models\Referral;
use App\Models\User;
use Livewire\Component;

class ListReferral extends Component
{
    public $perPage = 10;
    public $edit_id, $user, $code, $level, $komisi, $visitors, $registered;
    public function editUser($id)
    {
        $referral = Referral::find($id);
        if ($referral) {
            $user = User::find($referral->user_id);
            if ($user) {
                $this->user = $user->name;
            } else {
                $this->user = 'not found';
            }
            $this->edit_id = $referral->id;
            $this->code = $referral->code;
            $this->level = $referral->level;
            $this->komisi = $referral->komisi;
            $this->visitors = $referral->visitors;
            $this->registered = $referral->registered;
        }
    }
    public function editUsers()
    {
        $referral = Referral::find($this->edit_id);
        if ($referral) {
            $referral->update([
                'code' => $this->code,
                'level' => $this->level,
                'komisi' => $this->komisi,
                'visitors' => $this->visitors,
                'registered' => $this->registered,
            ]);
            $this->reset('edit_id', 'user', 'code', 'level', 'komisi', 'visitors', 'registered');
            $this->dispatch('swal:modal', [
                'title' => 'Success',
                'text' => 'Referral updated successfully',
                'type' => 'success',
            ]);
        }
    }
    public function deleteUser($id)
    {
        $referral = Referral::find($id);
        if ($referral) {
            $referral->delete();
            $this->dispatch('swal:modal', [
                'title' => 'Success',
                'text' => 'Referral deleted successfully',
                'type' => 'success',
            ]);
        }
    }
    public function render()
    {
        $referral = Referral::with('user')->orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.admin.referral.list-referral', compact('referral'));
    }
}
