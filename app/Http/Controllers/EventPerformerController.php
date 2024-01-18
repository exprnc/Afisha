<?php

namespace App\Http\Controllers;

use App\Models\EventPerformer;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPerformer;
use App\Models\Gender;
use App\Models\Performer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventPerformerController extends Controller
{
    public function showEventsPerformers()
    {
        $eventsPerformers = EventPerformer::all();
        $events = Event::all();
        $performers = Performer::all();
        return view('admin.event-performer.event-performer', compact('eventsPerformers', 'events', 'performers'));
    }

    public function createEventPerformer(Request $request)
    {
        $create = EventPerformer::create([
            'event_id' => $request->input('event_id'),
            'performer_id' => $request->input('performer_id'),
        ]);

        if($create){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное создание отношения :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function updateEventPerformer(EventPerformer $eventPerformer)
    {
        $events = Event::all();
        $performers = Performer::all();
        return view('admin.event-performer.update', compact('eventPerformer', 'events', 'performers'));
    }

    public function updateEventPerformer2(Request $request, EventPerformer $eventPerformer)
    {

        $update = $eventPerformer->update([
            'event_id' => $request->input('event_id'),
            'performer_id' => $request->input('performer_id'),
        ]);

        if($update){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование отношения :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function deleteEventPerformer(EventPerformer $eventPerformer)
    {
        if($eventPerformer->delete()){
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное удаление :)']);
        }else{
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }
}
