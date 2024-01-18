@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Создать отношение между событием и исполнителем</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.createEventPerformer') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="event_id" class="form-label">Событие</label>
                <select class="form-select" name="event_id" id="event_id">
                    @foreach($events as $event)
                    <option value="{{$event->id}}">{{$event->name}} • {{$event->formattedDate}} • {{$event->place->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="performer_id" class="form-label">Исполнитель</label>
                <select class="form-select" name="performer_id" id="performer_id">
                    @foreach($performers as $performer)
                    <option value="{{$performer->id}}">{{$performer->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="mt-3">События и Исполнители</h2>
        <div class="row">
            @foreach($eventsPerformers as $eventPerformer)
            <div class="card m-2" style="width: 18rem;">
                <img style="height:300px; object-fit:cover;" src="{{ asset("storage/image/{$eventPerformer->event->image}") }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h6 class="card-title">• {{$eventPerformer->event->name}} •</h6>
                    <h6 class="card-title">• {{$eventPerformer->performer->name}} •</h6>
                    <div class="card-body mr-3"
                        style="display:flex; justify-content:space-between; align-items:center;">
                        <a href="{{ route('admin.updateEventPerformer', $eventPerformer->id) }}" style="width:55%;"
                            class="card-link">Редактировать</a>
                        <form action="{{ route('admin.deleteEventPerformer', ['eventPerformer' => $eventPerformer->id]) }}" style="width:30%;"
                            method="POST">
                            @csrf
                            @method('post')
                            <button type="submit" class="card-link">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection('content')