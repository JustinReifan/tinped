<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Livewire\Admin\Konfigurasi\Bot;
use App\Models\Bot as ModelsBot;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function new()
    {
        return view('tickets.new');
    }
    public function proses(Request $request)
    {
        $request->validate(
            [
                'subject' => 'required',
                'type' => 'required',
                'content' => 'required',
            ],
            [
                'subject.required' => 'Subject tidak boleh kosong',
                'type.required' => 'Type Ticket tidak boleh kosong',
                'content.required' => 'Message tidak boleh kosong',
            ]
        );
        if ($request->type == 'order' or $request->type == 'deposit' or $request->type == 'other') {
            $id = 'TCK-' . time();
            $bot = ModelsBot::where('user_id', Auth::user()->id)->where('type', 'whatsapp')->where('status', '1')->first();
            if ($bot) {
                if ($bot->switch_tiket == '1') {
                    $data = [
                        'tiket_id' => $id,
                        'tipe_id' => $request->type,
                        'subjek' => $request->subject,
                        'message' => $request->content,
                    ];
                    $tiket =  Senderwhatsapp('notif_tiket', $data);
                }
            }
            $ticket = new Ticket();
            $ticket->user_id = auth()->user()->id;
            $ticket->ticket_id = $id;
            $ticket->subject = $request->subject;
            $ticket->type_ticket = $request->type;
            $ticket->message = $request->content;
            $ticket->status = 'open';
            $ticket->save();
            if ($ticket->save()) {
                $chat = new TicketChat();
                $chat->ticket_id = $id;
                $chat->user_id = auth()->user()->id;
                $chat->type = 'user';
                $chat->message = $request->content;
                $chat->save();
                return redirect()->route('ticket.chat', $id)->with('success', 'Ticket has been created!');
            } else {
                return redirect()->route('ticket.new')->with('error', 'Ticket failed to create!');
            }
        } else {
            return redirect()->route('ticket.new')->with('error', 'Type Ticket not found!');
        }
    }
    public function chat(Ticket $ticket)
    {
        return view('tickets.chat', compact('ticket'));
    }
    public function sendMessageTicket(Request $request)
    {
        $ticket = Ticket::where('ticket_id', $request->ticket_id)->first();
        if ($ticket) {
            $chat = new TicketChat();
            $chat->ticket_id = $request->ticket_id;
            $chat->user_id = auth()->user()->id;
            $chat->type = 'user';
            $chat->message = $request->message;
            $chat->save();
            if ($chat->save()) {
                $ticket->message = $request->message;
                $ticket->save();
                $last = TicketChat::where('ticket_id', $request->ticket_id)->orderBy('id', 'desc')->first();
                $user = User::where('id', $ticket->user_id)->first();
                $render = view('tickets.send-admin', compact('ticket', 'chat', 'last', 'user'))->render();
                $data = [
                    'type' => 'user',
                    'message' => $request->message,
                    'ticket_id' => $request->ticket_id,
                    'html' => $render
                ];
                // event(new ChatEvent($data));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Message has been sent!',
                    'html' => view('tickets.user-send', compact('ticket', 'last'))->render()
                ]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Message failed to send!']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ticket not found!']);
        }
    }
    public function history()
    {
        return view('tickets.history');
    }
}
