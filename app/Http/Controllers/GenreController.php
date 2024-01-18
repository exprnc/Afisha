<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gender;
use App\Models\Genre;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        $genders = Gender::all();
        $mainSliderEvents = $genre->events()->take(5)->get();
        $events = $genre->events()->paginate(9);
        $firstEvent = $genre->events()->take(1)->get();
        if($user = Auth::user()) {
            $watchs = Watch::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            return view('genre.show', compact('genre', 'genders', 'events', 'watchs', 'user', 'firstEvent', 'mainSliderEvents'));
        }else{
            return view('genre.show', compact('genre', 'genders', 'events', 'firstEvent', 'mainSliderEvents'));
        }
    }

    public function showGenres()
    {
        $genres = Genre::all();
        return view('admin.genre.genres', compact('genres'));
    }

    public function createGenre(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
        ],[
            'name.required' => 'Название обязательно',
            'image.image' => 'Выберите в формате jpeg,png,jpg,svg',
            'image.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
        ]);

        if ($file = $request->file('image')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }

        $create = Genre::create([
            'name' => $request->input('name'),
            'image' => $file_name,
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание жанра :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updateGenre(Genre $genre)
    {
        return view('admin.genre.update', compact('genre'));
    }

    public function updateGenre2(Request $request, Genre $genre)
    {
        if ($file = $request->file('image')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }else{
            $file_name = $genre->image;
            $request->merge(['image' => $file_name]);
        }

        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Название обязательно',
            'image.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
        ]);

        $update = $genre->update([
            'name' => $request->input('name'),
            'image' => $file_name,
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование жанра :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deleteGenre(Genre $genre)
    {
        if($genre->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }
}
