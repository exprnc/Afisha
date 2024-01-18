@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Редактировать событие</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.updateEvent', $event->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ $event->description }}</textarea>
                @error('description')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image-input" class="form-label">Картинка</label>
                <input class="form-control" type="file" id="image-input" name="image">
                <img id="selected-image" src="{{ asset("storage/image/{$event->image}") }}" class="img-thumbnail m-3" alt="...">
                @error('image')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Дата</label>
                <input class="form-control" type="date" id="date" name="date" value="{{ $event->date }}">
                @error('date')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Время</label>
                <input class="form-control" type="time" id="time" name="time" step="1" value="{{ $event->time }}">
                @error('time')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="age_limit_id" class="form-label">Возрастное ограничение</label>
                <select class="form-select" name="age_limit_id" id="age_limit_id">
                    @foreach($ages as $age)
                    <option value="{{$age->id}}" {{ $event->age_limit_id === $age->id ? ' selected ' : ' ' }}>{{$age->limit}}+</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="subgenre_id" class="form-label">Поджанр</label>
                <select class="form-select" name="subgenre_id" id="subgenre_id">
                    @foreach($subgenres as $subgenre)
                    <option value="{{$subgenre->id}}" {{ $event->subgenre_id === $subgenre->id ? ' selected ' : ' ' }}>{{$subgenre->name}} • {{$subgenre->genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="place_id" class="form-label">Место проведения</label>
                <select class="form-select" name="place_id" id="place_id">
                    @foreach($places as $place)
                    <option value="{{$place->id}}" {{ $event->place_id === $place->id ? 'selected' : ' ' }}>{{$place->name}} • {{$place->city->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
</section>
<script>
    document.getElementById('image-input').addEventListener('change', function (event) {
      const input = event.target;
      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          document.getElementById('selected-image').src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
      }
    });
</script>
@endsection('content')