<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPerformer;
use App\Models\Gender;
use App\Models\User;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $watchedEntry = Watch::where('event_id', $event->id)->first();

        if (!$watchedEntry && $user = Auth::user()) {
            Watch::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ]);
        }
        $events = $event->subgenre->genre->events()
        ->where('events.id', '!=', $event->id)
        ->paginate(3);
        $performers = $event->performers;
        $genders = Gender::all();
        if($user = Auth::user()){
            $watchs = Watch::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            return view('event.show', compact('event', 'performers', 'genders', 'user', 'watchs', 'events'));
        }
        return view('event.show', compact('event', 'performers', 'genders', 'events'));
    }
}