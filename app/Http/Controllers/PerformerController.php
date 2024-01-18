<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Performer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerformerController extends Controller
{
    public function show(Performer $performer)
    {
        $genders = Gender::all();
        $events = $performer->events()->paginate(10);
        if($user = Auth::user()){
            return view('performer.show', compact('performer', 'genders', 'events', 'user'));
        }
        return view('performer.show', compact('performer', 'genders', 'events'));
    }

    public function showPerformers()
    {
        $performers = Performer::all();
        return view('admin.performer.performers', compact('performers'));
    }

    public function createPerformer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,svg',
        ],[
            'name.required' => 'Название обязательно',
            'description.required' => 'Описание обязательно',
            'photo.image' => 'Выберите в формате jpeg,png,jpg,svg',
            'photo.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
        ]);

        if ($file = $request->file('photo')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }

        $create = Performer::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $file_name,
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание исполнителя :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updatePerformer(Performer $performer)
    {
        return view('admin.performer.update', compact('performer'));
    }

    public function updatePerformer2(Request $request, Performer $performer)
    {
        if ($file = $request->file('photo')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }else{
            $file_name = $performer->photo;
            $request->merge(['photo' => $file_name]);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Название обязательно',
            'description.required' => 'Описание обязательно',
            'photo.mimes' => 'Выберите в формате jpeg,png,jpg,svg',
        ]);

        $update = $performer->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $file_name,
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование исполнителя :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deletePerformer(Performer $performer)
    {
        if($performer->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }
}
