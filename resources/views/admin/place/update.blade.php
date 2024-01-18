@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Редактировать событие</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.updatePlace2', $place->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $place->name }}">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $place->address }}">
                @error('address')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image-input" class="form-label">Картинка</label>
                <input  class="form-control" type="file" id="image-input" name="image">
                <img id="selected-image" src="{{ asset("storage/image/{$place->image}") }}" class="img-thumbnail m-3" alt="...">
                @error('image')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image-input2" class="form-label">Схема</label>
                <input  class="form-control" type="file" id="image-input2" name="scheme">
                <img id="selected-image2" src="{{ asset("storage/image/{$place->scheme}") }}" class="img-thumbnail m-3" alt="...">
                @error('scheme')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ $place->description }}</textarea>
                @error('description')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city_id" class="form-label">Город</label>
                <select class="form-select" name="city_id" id="city_id">
                    @foreach($cities as $city)
                    <option value="{{$city->id}}" {{ $place->city_id === $city->id ? ' selected ' : ' ' }}>{{$city->name}}</option>
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