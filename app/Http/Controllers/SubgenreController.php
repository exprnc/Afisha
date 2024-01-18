<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Subgenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubgenreController extends Controller
{
    public function showSubgenres()
    {
        $subgenres = Subgenre::all();
        $genres = Genre::all();
        return view('admin.subgenre.subgenres', compact('subgenres', 'genres'));
    }

    public function createSubgenre(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Название обязательно',
        ]);

        $create = Subgenre::create([
            'name' => $request->input('name'),
            'genre_id' => $request->input('genre_id'),
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание поджанра :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updateSubgenre(Subgenre $subgenre)
    {
        $genres = Genre::all();
        return view('admin.subgenre.update', compact('subgenre', 'genres'));
    }

    public function updateSubgenre2(Request $request, Subgenre $subgenre)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Название обязательно',
        ]);

        $update = $subgenre->update([
            'name' => $request->input('name'),
            'genre_id' => $request->input('genre_id'),
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование поджанра :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deleteSubgenre(Subgenre $subgenre)
    {
        if($subgenre->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }
}
