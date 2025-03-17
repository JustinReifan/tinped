<?php

namespace App\Livewire\Chat;

use App\Models\TicketChat;
use Livewire\Component;

class User extends Component
{
    public $ticket;
    public function refresh($data) {}
    public function sendMessage($message, $ticket_id)
    {
        TicketChat::create([
            'ticket_id' => $ticket_id,
            'user_id' => auth()->user()->id,
            'type' => 'user',
            'message' => $message,
        ]);
        $data = [
            'ticket_id' => $ticket_id,
            'message' => $message,
        ];
        sendmessage($data);
    }
    public function render()
    {
        $this->dispatch('scrolldown');
        return view('livewire.chat.user', ['ticket' => $this->ticket]);
    }
}
