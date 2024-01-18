<?php

namespace App\Http\Controllers;

use App\Models\AgeLimit;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Place;
use App\Models\Subgenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $ages = AgeLimit::all();
        $subgenres = Subgenre::orderBy('genre_id', 'asc')->get();
        $places = Place::orderBy('city_id', 'asc')->get();
        return view('admin.admin', compact('events', 'ages', 'subgenres', 'places'));
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s'
        ],[
            'name.required' => 'Название обязательно',
            'description.required' => 'Описание обязательно',
            'time.required' => 'Картинка обязательна',
            'image.image' => 'Выберите в формате jpeg,png,jpg,svg',
            'image.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
            'date.required' => 'Дата обязательна'
        ]);

        if ($file = $request->file('image')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }

        $create = Event::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $file_name,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'age_limit_id' => $request->input('age_limit_id'),
            'subgenre_id' => $request->input('subgenre_id'),
            'place_id' => $request->input('place_id')
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание события :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deleteEvent(Event $event){
        if($event->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updateEvent(Request $request, Event $event){
        if ($file = $request->file('image')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }else{
            $file_name = $event->image;
            $request->merge(['image' => $file_name]);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s'
        ],[
            'name.required' => 'Название обязательно',
            'description.required' => 'Описание обязательно',
            'time.required' => 'Картинка обязательна',
            'image.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
            'date.required' => 'Дата обязательна'
        ]);

        $update = $event->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $file_name,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'age_limit_id' => $request->input('age_limit_id'),
            'subgenre_id' => $request->input('subgenre_id'),
            'place_id' => $request->input('place_id')
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование события :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updateIndex(Event $event)
    {
        $ages = AgeLimit::all();
        $subgenres = Subgenre::orderBy('genre_id', 'asc')->get();
        $places = Place::orderBy('city_id', 'asc')->get();
        return view('admin.event.update', compact('event', 'ages', 'subgenres', 'places'));
    }

    public function signout()
    {
        Session::flush();
        if(!Auth::logout()){
            return redirect('/')->with('alert', ['type' => 'success', 'message' => 'Вы вышли из аккаунта :)']);
        }
        return redirect('/')->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
    }
}
