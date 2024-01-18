<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Gender;
use App\Models\Place;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function show(Place $place)
    {
        $genders = Gender::all();
        $eventsSecond = $place->events()->paginate(6);
        $events = $place->events()->paginate(10);
        if($user = Auth::user()){
            $watchs = Watch::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            return view('place.show', compact('place', 'genders', 'user', 'eventsSecond', 'events', 'watchs'));
        }
        return view('place.show', compact('place', 'genders', 'eventsSecond', 'events'));
    }

    public function showPlaces()
    {
        $places = Place::all();
        $cities = City::all();
        return view('admin.place.place', compact('places', 'cities'));
    }

    public function createPlace(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'scheme' => 'required|image|mimes:jpeg,png,jpg,svg',
            'description' => 'required',
        ],[
            'name.required' => 'Название обязательно',
            'address.required' => 'Адрес обязателен',
            'image.image' => 'Выберите в формате jpeg,png,jpg,svg',
            'image.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
            'scheme.image' => 'Выберите в формате jpeg,png,jpg,svg',
            'scheme.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
            'description.required' => 'Описание обязательно',
        ]);

        if ($file = $request->file('image')) {
            $file_name_img = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name_img);
        }

        if ($file = $request->file('scheme')) {
            $file_name_sch = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name_sch);
        }

        $create = Place::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'image' => $file_name_img,
            'scheme' => $file_name_sch,
            'total_number_of_seats' => 1000,
            'remaining_number_of_seats' => 0,
            'description' => $request->input('description'),
            'city_id' => $request->input('city_id')
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание развлекательного центра :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deletePlace(Place $place){
        if($place->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updatePlace(Place $place)
    {
        $cities = City::all();
        return view('admin.place.update', compact('place', 'cities'));
    }

    public function updatePlace2(Request $request, Place $place){
        if ($file = $request->file('image')) {
            $file_name_img = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name_img);
        }else{
            $file_name_img = $place->image;
            $request->merge(['image' => $file_name_img]);
        }

        if ($file = $request->file('scheme')) {
            $file_name_sch = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name_sch);
        }else{
            $file_name_sch = $place->scheme;
            $request->merge(['scheme' => $file_name_sch]);
        }

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Название обязательно',
            'address.required' => 'Адрес обязателен',
            'description.required' => 'Описание обязательно',
        ]);

        $update = $place->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'image' => $file_name_img,
            'scheme' => $file_name_sch,
            'total_number_of_seats' => 1000,
            'remaining_number_of_seats' => 0,
            'description' => $request->input('description'),
            'city_id' => $request->input('city_id')
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование развлекательного центра :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }
}
