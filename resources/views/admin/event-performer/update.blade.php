@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Редактировать отношение</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.updateEventPerformer2', $eventPerformer->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="event_id" class="form-label">Событие</label>
                <select class="form-select" name="event_id" id="event_id">
                    @foreach($events as $event)
                    <option value="{{$event->id}}" {{ $event->id === $eventPerformer->event->id ? ' selected ' : ' ' }}>{{$event->name}} • {{$event->formattedDate}} • {{$event->place->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="performer_id" class="form-label">Исполнитель</label>
                <select class="form-select" name="performer_id" id="performer_id">
                    @foreach($performers as $performer)
                    <option value="{{$performer->id}}" {{ $performer->id === $eventPerformer->performer->id ? ' selected ' : ' ' }}>{{$performer->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
</section>
@endsection('content')