@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Создать развлекательный центр</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.createPlace') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" id="address" name="address">
                @error('address')
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
                <label for="image-input2" class="form-label">Схема</label>
                <input  class="form-control" type="file" id="image-input2" name="scheme">
                <img id="selected-image2" src="..." class="img-thumbnail m-3" alt="...">
                @error('scheme')
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
                <label for="city_id" class="form-label">Город</label>
                <select class="form-select" name="city_id" id="city_id">
                    @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="mt-3">Развлекательные центры</h2>
        <div class="row">
            @foreach($places as $place)
            <div class="card m-2" style="width: 18rem;">
                <img src="{{ asset("storage/image/{$place->image}") }}" class="card-img-top" style="height:170px; object-fit:cover;"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$place->name}}</h5>
                    <p style="height:100px; overflow:hidden;" class="card-text">{{$place->description}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Город: {{$place->city->name}}</li>
                </ul>
                <div class="card-body mr-3" style="display:flex; justify-content:space-between; align-items:center;">
                    <a href="{{ route('admin.updatePlace', $place->id) }}" style="width:50%;" class="card-link">Редактировать</a>
                    <form action="{{ route('admin.deletePlace', ['place' => $place->id]) }}" style="width:30%;" method="POST">
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
    document.getElementById('image-input2').addEventListener('change', function (event) {
      const input = event.target;
      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          document.getElementById('selected-image2').src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
      }
    });
</script>
@endsection('content')