@extends('partials.header-footer')
@section('content')
<section class="area-sec">
    <div class="container">
        <div class="artist-info-block">
            <img src="{{ asset("storage/image/{$place->image}") }}" alt="">
            <h2>{{ $place->name }}</h2>
        </div>
        <div class="area-info-block">
            <div class="area-about-text">
                <h2>О площадке</h2>
                <p>Развлекательный центр «Огни Уфы» появился в 2004 году. Комплекс площадью 8000 квадратных метров
                    быстро стал популярным и модным местом. В 2019 году проектом заинтересовались представители
                    «Тинькофф Банк», и на следующие три года «Огни Уфы» сменили вывеску на «Тинькофф Холл Уфа».
                    Следом за переименованием пошли инвестиции, в том числе — в программу концертной площадки. Афиша
                    «Тинькофф Холла» пестрит разноплановыми шоу: легенды</p>
            </div>
            <div class="events-coming-sec">
                <h2>События</h2>
                <div class="events-coming-main">
                    @foreach($eventsSecond as $event) <a href="{{ route('event.show', $event->id) }}" class="event-coming">
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
                <div class="pagination">{{ $eventsSecond->links() }}</div>
            </div>
        </div>
    </div>
</section>
<section class="hall-scheme-sec">
    <div class="container">
        <h2 class="area-scheme-h">Схема площадки</h2>
        <div class="hall-scheme">
            <img src="{{ asset("storage/image/{$place->scheme}") }}" alt="">
        </div>
    </div>
</section>
<section class="area-afisha-sec">
    <div class="container">
    <div class="artist-concerts-top">
                <h2>Афиша</h2>
                <div class="artist-concerts-main">
                    @foreach($events as $event)
                    <div class="artist-upcoming-concert">
                        <div class="artist-upc-concert-main-info">
                            <p>{{ $event->subgenre->name }}</p>
                            <div>{{ $event->name }}</div>
                        </div>
                        <div class="artist-upc-concert-date">
                            <h2>{{ $event->formattedDate }}</h2>
                        </div>
                        <div class="artist-upc-concert-loc">
                            <p>{{ $event->place->city->name }}</p>
                            <a href="{{ route('place.show', $event->place->id) }}">{{ $event->place->name }}</a>
                        </div>
                        <div class="artist-upc-concert-buy">
                            <a href="{{ route('event.show', $event->id) }}">Купить билеты</a>
                        </div>
                    </div>
                    @endforeach
                    <div class="pagination">{{ $events->links() }}</div>
                </div>
            </div>
    </div>
    </div>
</section>
<section class="area-address-sec">
    <div class="container">
        <div class="event-address">
            <h2>Адрес</h2>
            <script class="event-map" type="text/javascript" charset="utf-8" async
                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7913f1248fd99fb896f340a06357eaf7c6fa7429899c8c5bcc6e013f0ffb04e0&amp;width=1200&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>
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