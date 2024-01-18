<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function showCities()
    {
        $cities = City::all();
        return view('admin.city.city', compact('cities'));
    }

    public function createCity(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Название обязательно',
        ]);

        $create = City::create([
            'name' => $request->input('name'),
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание города :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deleteCity(City $city){
        if($city->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updateCity(City $city)
    {
        return view('admin.city.update', compact('city'));
    }

    public function updateCity2(Request $request, City $city){
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Название обязательно',
        ]);

        $update = $city->update([
            'name' => $request->input('name'),
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование города :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }
}
