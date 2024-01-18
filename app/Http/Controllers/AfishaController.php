<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gender;
use App\Models\Genre;
use App\Models\User;
use App\Models\Watch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AfishaController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $mainSliderEvents = Event::orderBy('created_at', 'desc')->take(5)->get();
        $firstEvent = Event::orderBy('created_at', 'desc')->take(1)->get();
        $favoriteEventsForSlider = Event::leftJoin('tickets', 'events.id', '=', 'tickets.event_id')
        ->groupBy('events.id')
        ->orderByRaw('COUNT(tickets.event_id) DESC')
        ->select('events.*', DB::raw('COUNT(tickets.event_id) as ticket_count'))->get();
        $favoriteEvents = $events = Event::leftJoin('favorites', 'events.id', '=', 'favorites.event_id')
        ->groupBy('events.id')
        ->orderByRaw('COUNT(favorites.event_id) DESC')
        ->select('events.*', DB::raw('COUNT(favorites.event_id) as favorite_count'))
        ->paginate(6);
        $genders = Gender::all();
        $upcomingEvents = Event::orderBy('date')->paginate(3);

        if($user = Auth::user()) {
            $watchs = Watch::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            return view('afisha.index', compact('genres', 'firstEvent', 'favoriteEventsForSlider', 'favoriteEvents', 'mainSliderEvents', 'genders', 'watchs', 'upcomingEvents', 'user'));
        }else{
            return view('afisha.index', compact('genres', 'firstEvent', 'favoriteEventsForSlider', 'favoriteEvents', 'mainSliderEvents', 'genders', 'upcomingEvents'));
        }
    }
}
