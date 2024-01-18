@extends('partials.header-footer')
@section('content')
<section class="detail-event-sec">
    <div class="container">
        <div class="detail-event-main-block">
            <div class="det-event-img">
                <img src="{{ asset("storage/image/{$event->image}") }}" alt="">
                <div class="det-event-info">
                    <p>{{ $event->subgenre->name }} • {{ $event->age->limit }}+</p>
                    <h2>{{ $event->name }}</h2>
                    <p>{{ $event->formattedDate }} • <a href="{{ route('place.show', $event->place->id) }}">{{ $event->place->name }}</a></p>
                </div>
                <div class="det-event-buy-block">
                    @if ($event->isLikedByUser(auth()->id()))
                    <form action="{{ route('ticket.create', $event->id) }}" method="post">
                        @csrf
                        <button class="event-buy-tickets">Купить билеты</button>
                    </form>
                    <form action="{{ route('favorite.disLikeEvent', $event->id) }}" method="post">
                        @csrf
                        <button class="event-like" type="submit"><img src="{{ asset('storage/image/ic_like.png') }}" alt=""></button>
                    </form>
                    @else
                    <form action="{{ route('ticket.create', $event->id) }}" method="post">
                        @csrf
                        <button class="event-buy-tickets">Купить билеты</button>
                    </form>
                    <form action="{{ route('favorite.likeEvent', $event->id) }}" method="post">
                        @csrf
                        <button class="event-like" type="submit"><img src="{{ asset('storage/image/ic_dislike.png') }}" alt=""></button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="hall-scheme-sec">
    <div class="container">
        <img class="hall-scheme" src="{{ asset("storage/image/{$event->place->scheme}") }}">
    </div>
</section>
<section class="event-about-sec">
    <div class="container">
        <div class="event-about-main">
            <h2>О концерте</h2>
            <p>{{ $event->description }}</p>
        </div>
        <div class="event-about-performers">
            <h2>Исполнители</h2>
            <div class="event-performers">
                @foreach($performers as $performer)
                <a class="event-performer" href="{{ route('performer.show', $performer) }}">
                    <img src="{{ asset("storage/image/{$performer->photo}") }}" alt="">
                    <span>{{ $performer->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        <div class="event-address">
            <h2>Адрес</h2>
            <script class="event-map" type="text/javascript" charset="utf-8" async
                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7913f1248fd99fb896f340a06357eaf7c6fa7429899c8c5bcc6e013f0ffb04e0&amp;width=1200&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</section>
<section class="events-coming-sec">
    <div class="container">
        <a class="events-coming-h">
            <h2>Вам может понравиться</h2>
            <img src="{{ asset("storage/image/ic_arrow_right.png") }}" alt="">
        </a>
        <div class="events-coming-main">
            @foreach($events as $event) <a href="{{ route('event.show', $event->id) }}" class="event-coming">
                    <div class="event-coming-img-info">
                        <img class="event-coming-img" src="{{ asset("storage/image/{$event->image}") }}" alt="">
                        <div class="event-coming-img-text-info">
                            <img class="event-top-img" src="{{ asset("storage/image/ic_top.png") }}" alt="...">
                            @if ($event->isLikedByUser(auth()->id()))
                            <form action="{{ route('favorite.disLikeEvent', $event->id) }}" method="post">
                                @csrf
                                <button type="submit"><img class="event-like-img" src="{{ asset("storage/image/ic_like.png") }}" alt=""></button>
                            </form>
                            @else
                            <form action="{{ route('favorite.likeEvent', $event->id) }}" method="post">
                                @csrf
                                <button type="submit"><img class="event-like-img" src="{{ asset("storage/image/ic_dislike.png") }}" alt=""></button>
                            </form>
                            @endif
                            <div>от 2000 ₽</div>
                        </div>
                    </div>
                    <div class="event-coming-text-info">
                        <h2>{{ $event->name }}</h2>
                        <span>{{ $event->formattedDate }}</span>
                        <span>{{ $event->place->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<section class="checked-sec">
    <div class="container">
            @if(isset($watchs))
            <h2>Вы смотрели</h2>
            <div class="checked-container">
                @foreach($watchs as $watch)
                <a href="{{ route('event.show', $watch->event->id) }}" class="checked-block">
                    <img src="{{ asset("storage/image/{$watch->event->image}") }}" alt="">
                    <div class="checked-info">
                        <p>{{{$watch->event->name}}}</p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
    </div>
</section>
@endsection('content')