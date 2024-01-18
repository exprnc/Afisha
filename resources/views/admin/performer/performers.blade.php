@extends('admin.partials.adm-header')
@section('content')
<section>
    <div class="container">
        <h2 class="mt-3">Создать исполнителя</h2>
        <form class="mb-3" method="POST" action="{{ route('admin.createPerformer') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
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
                <input class="form-control" type="file" id="image-input" name="photo">
                <img id="selected-image" src="..." class="img-thumbnail m-3" alt="...">
                @error('photo')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="mt-3">Исполнители</h2>
        <div class="row">
            @foreach($performers as $performer)
            <div class="card m-2" style="width: 18rem;">
                <img style="object-fit:cover; height:300px;" src="{{ asset("storage/image/{$performer->photo}") }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$performer->name}}</h5>
                    <p class="card-text" style="height: 200px; overflow:hidden;">{{$performer->description}}</p>
                    <div class="card-body mr-3"
                        style="display:flex; justify-content:space-between; align-items:center;">
                        <a href="{{ route('admin.updatePerformer', $performer->id) }}" style="width:55%;"
                            class="card-link">Редактировать</a>
                        <form action="{{ route('admin.deletePerformer', ['performer' => $performer->id]) }}" style="width:30%;"
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