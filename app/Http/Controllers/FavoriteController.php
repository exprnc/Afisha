<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Favorite;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $genders = Gender::all();
        return view('favorite.favorites', compact('favorites', 'genders', 'user'));
    }

    public function likeEvent(Event $event)
    {
        if ($user = Auth::user()) {
            $create = Favorite::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ]);
            if ($create) {
                return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Вы лайкнули событие :)']);
            } else {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что-то пошло не так :(']);
            }
        } else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Сначала авторизуйтесь :)']);
        }
    }

    public function dislikeEvent(Event $event)
    {
        if ($user = Auth::user()) {
            $delete = Favorite::where('event_id', $event->id)->delete();
            if ($delete) {
                return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Дизлайк :(']);
            } else {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что-то пошло не так :(']);
            }
        } else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Сначала авторизуйтесь :)']);
        }
    }
}
