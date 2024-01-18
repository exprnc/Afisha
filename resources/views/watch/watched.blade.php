@extends('partials.header-footer')
@section('content')
<section class="my-sec">
    <div class="container">
        <h2 class="my-h">Моя афиша</h2>
        <div class="my-nav-buttons">
        <a class="my-nav-button" href="{{ route('ticket.index') }}">Мои билеты</a>
            <a class="my-nav-button" href="{{ route('favorite.index') }}">Избранное</a>
            <a class="my-nav-button" href="{{ route('watch.index') }}">Я смотрел</a>
            <a class="my-nav-button" href="{{ route('me.index') }}">Мой аккаунт</a>
            <a class="my-nav-button-out" href="{{ route('signout') }}">Выход</a>
        </div>
        <div class="my-watched-main">
            @if($watchs->isEmpty()) 
            <div class="empty-mess">Здесь пока пусто</div> 
            @endif
            @foreach($watchs as $watch)
            <a href="{{ route('event.show', $watch->event->id) }}" class="checked-block">
                <img src="{{ asset("storage/image/{$watch->event->image}") }}" alt="">
                <div class="checked-info">
                    <p>{{ $watch->event->name }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection('content')