<?php

namespace App\Livewire\User;

use App\Models\Session as ModelsSession;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Session extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function removeSession($id)
    {
        $session = ModelsSession::where('user_id', auth()->id())->where('id', $id)->first();
        if ($session) {
            $session->status = 'remove';
            $session->save();
        }
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Session berhasil dihapus',
            'type' => 'success',
        ]);
    }
    public function render()
    {
        $session = DB::table('sessions')->where('user_id', auth()->id())->paginate(10);
        $this->dispatch('closeLoader');
        return view('livewire.user.session', compact('session'));
    }
}
