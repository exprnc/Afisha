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
        <div class="my-favorites-main">
            @if($favorites->isEmpty()) 
            <div class="empty-mess">Здесь пока пусто</div> 
            @endif
            @foreach($favorites as $favorite)
            <a href="{{ route('event.show', $favorite->event->id) }}" class="event-coming">
                    <div class="event-coming-img-info">
                        <img class="event-coming-img" src="{{ asset("storage/image/{$favorite->event->image}") }}" alt="">
                        <div class="event-coming-img-text-info">
                            <img class="event-top-img" src="{{ asset("storage/image/ic_top.png") }}" alt="...">
                            @if ($favorite->event->isLikedByUser(auth()->id()))
                            <form action="{{ route('favorite.disLikeEvent', $favorite->event->id) }}" method="post">
                                @csrf
                                <button type="submit"><img class="event-like-img" src="{{ asset("storage/image/ic_like.png") }}" alt=""></button>
                            </form>
                            @else
                            <form action="{{ route('favorite.likeEvent', $favorite->event->id) }}" method="post">
                                @csrf
                                <button type="submit"><img class="event-like-img" src="{{ asset("storage/image/ic_dislike.png") }}" alt=""></button>
                            </form>
                            @endif
                            <div>от 2000 ₽</div>
                        </div>
                    </div>
                    <div class="event-coming-text-info">
                        <h2>{{ $favorite->event->name }}</h2>
                        <span>{{ $favorite->event->formattedDate }}</span>
                        <span>{{ $favorite->event->place->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection('content')