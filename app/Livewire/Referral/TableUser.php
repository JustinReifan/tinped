<?php

namespace App\Livewire\Referral;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TableUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $referral;
    public function render()
    {
        $user = User::where('referral', $this->referral->code)->paginate(5);
        return view('livewire.referral.table-user', compact('user'));
    }
}
