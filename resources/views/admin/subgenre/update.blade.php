@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Редактировать Поджанр</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.updateSubgenre2', $subgenre->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$subgenre->name}}">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="age_limit_id" class="form-label">Жанр</label>
                <select class="form-select" name="genre_id" id="genre_id">
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}" {{ $subgenre->genre_id === $genre->id ? ' selected ' : ' ' }}>{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
</section>
@endsection('content')