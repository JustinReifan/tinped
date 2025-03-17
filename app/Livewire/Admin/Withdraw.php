<?php

namespace App\Livewire\Admin;

use App\Models\ReferralWithdraw;
use Livewire\Component;

class Withdraw extends Component
{
    public $perPage = 10, $search;
    public function render()
    {
        $withdraw = ReferralWithdraw::with('user')->search($this->search)->orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.admin.withdraw', compact('withdraw'));
    }
}
