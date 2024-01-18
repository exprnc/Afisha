@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Создать поджанр</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.createSubgenre') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="age_limit_id" class="form-label">Жанр</label>
                <select class="form-select" name="genre_id" id="genre_id">
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="mt-3">Поджанры</h2>
        <div class="row">
            @foreach($subgenres as $subgenre)
            <div class="card m-2" style="width: 18rem;">
                <img src="{{ asset("storage/image/{$subgenre->genre->image}") }}" class="card-img-top" style="height:170px; object-fit:cover;"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$subgenre->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Жанр: {{ $subgenre->genre->name }}</li>
                </ul>
                <div class="card-body mr-3" style="display:flex; justify-content:space-between; align-items:center;">
                    <a href="{{ route('admin.updateSubgenre', $subgenre->id) }}" style="width:50%;" class="card-link">Редактировать</a>
                    <form action="{{ route('admin.deleteSubgenre', ['subgenre' => $subgenre->id]) }}" style="width:30%;" method="POST">
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