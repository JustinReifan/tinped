<?php

namespace App\Livewire\Admin;

use App\Models\Bot;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\User;
use Livewire\Component;

class TiketChat extends Component
{
    public $ticket;
    public function refresh($data) {}
    public function sendMessage($message, $ticket_id)
    {
        $cek = TicketChat::where([['ticket_id', $ticket_id], ['type', 'admin']])->count();
        if ($cek == 0) {
            $tiket = Ticket::where('ticket_id', $ticket_id)->first();
            $bot = Bot::where('user_id', $tiket->user_id)->where('type', 'whatsapp')->where('status', '1')->first();
            if ($bot) {
                if ($bot->switch_tiket == '1') {
                    $data = [
                        'user_id' => $tiket->user_id,
                        'tiket_id' => $ticket_id,
                        'message' => $message,
                    ];
                    Senderwhatsapp('reply_tiket', $data);
                }
            }
        }
        TicketChat::create([
            'ticket_id' => $ticket_id,
            'user_id' => auth()->user()->id,
            'type' => 'admin',
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
        return view('livewire.admin.tiket-chat');
    }
}
