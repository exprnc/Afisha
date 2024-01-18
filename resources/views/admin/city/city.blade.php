@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Создать город</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.createCity') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="mt-3">Города</h2>
        <div class="row">
            @foreach($cities as $city)
            <div class="card m-2" style="width: 18rem;">
                <img src="{{ asset("storage/image/city.png") }}" class="card-img-top" style="height:170px; object-fit:cover;"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$city->name}}</h5>
                </div>
                <div class="card-body mr-3" style="display:flex; justify-content:space-between; align-items:center;">
                    <a href="{{ route('admin.updateCity', $city->id) }}" style="width:50%;" class="card-link">Редактировать</a>
                    <form action="{{ route('admin.deleteCity', ['city' => $city->id]) }}" style="width:30%;" method="POST">
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
@endsection('content')