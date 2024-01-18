<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gender;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $genders = Gender::all();
        $tickets = Ticket::where('user_id', $user->id)->get();
        return view('ticket.tickets', compact('genders', 'tickets', 'user'));
    }
    public function create(Event $event)
    {
        if ($user = Auth::user()) {
            $existingTicket = Ticket::where('user_id', $user->id)
                ->where('event_id', $event->id)
                ->first();

            if ($existingTicket) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Вы уже купили билет на это событие :)']);
            }

            $create = Ticket::create([
                'quantity' => 1,
                'user_id' => $user->id,
                'event_id' => $event->id,
                'seat_id' => 1,
            ]);

            if ($create) {
                return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Вы купили билет :)']);
            } else {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что-то пошло не так :(']);
            }
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Сначала авторизуйтесь :)']);
        }
    }

    public function delete(Event $event)
    {
        $user = Auth::user();
        $delete = Ticket::where('event_id', $event->id)
        ->where('user_id', $user->id)
        ->delete();
        if ($delete) {
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Вы вернули билет :(']);
        } else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что-то пошло не так :(']);
        }
    }
}
