@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Создать событие</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.createEvent') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                @error('description')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image-input" class="form-label">Картинка</label>
                <input  class="form-control" type="file" id="image-input" name="image">
                <img id="selected-image" src="..." class="img-thumbnail m-3" alt="...">
                @error('image')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Дата</label>
                <input class="form-control" type="date" id="date" name="date">
                @error('date')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Время</label>
                <input class="form-control" type="time" id="time" name="time" step="1">
                @error('time')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="age_limit_id" class="form-label">Возрастное ограничение</label>
                <select class="form-select" name="age_limit_id" id="age_limit_id">
                    @foreach($ages as $age)
                    <option value="{{$age->id}}">{{$age->limit}}+</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="subgenre_id" class="form-label">Поджанр</label>
                <select class="form-select" name="subgenre_id" id="subgenre_id">
                    @foreach($subgenres as $subgenre)
                    <option value="{{$subgenre->id}}">{{$subgenre->name}} • {{$subgenre->genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="place_id" class="form-label">Место проведения</label>
                <select class="form-select" name="place_id" id="place_id">
                    @foreach($places as $place)
                    <option value="{{$place->id}}">{{$place->name}} • {{$place->city->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="mt-3">События</h2>
        <div class="row">
            @foreach($events as $event)
            <div class="card m-2" style="width: 18rem;">
                <img src="{{ asset("storage/image/{$event->image}") }}" class="card-img-top" style="height:170px; object-fit:cover;"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$event->name}}</h5>
                    <p style="height:100px; overflow:hidden;" class="card-text">{{$event->description}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Поджанр: {{$event->subgenre->name}} • {{$event->subgenre->genre->name}}</li>
                    <li class="list-group-item">Дата: {{$event->formattedDate}}</li>
                    <li class="list-group-item">Время: {{$event->formattedTime}}</li>
                    <li class="list-group-item">Место: {{$event->place->name}}</li>
                    <li class="list-group-item">Возраст: {{$event->age->limit}}+</li>
                </ul>
                <div class="card-body mr-3" style="display:flex; justify-content:space-between; align-items:center;">
                    <a href="{{ route('admin.updateIndex', $event->id) }}" style="width:50%;" class="card-link">Редактировать</a>
                    <form action="{{ route('admin.deleteEvent', ['event' => $event->id]) }}" style="width:30%;" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="card-link">Удалить</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
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