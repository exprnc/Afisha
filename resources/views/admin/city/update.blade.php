@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Редактировать событие</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.updateCity2', $city->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $city->name }}">
                @error('name')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
</section>
@endsection('content')