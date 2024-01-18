<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\Watch;
use Illuminate\Support\Facades\Auth;

class WatchController extends Controller
{
    public function index()
    {
        // $genres = Genre::all();
        // $events = Event::all();
        $genders = Gender::all();

        $user = Auth::user();
        $watchs = Watch::where('user_id', $user->id)->get();
        return view('watch.watched', compact('watchs', 'genders', 'user'));
    }
}
