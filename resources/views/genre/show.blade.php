@extends('partials.header-footer')
@section('content')
<section class="main-slider-sec">
    <div class="container">
        <div class="slider">
                <div class="slider-line">
                    @foreach($mainSliderEvents as $event)
                    <div class="slide">
                        <img class="slider-img" src="{{ asset("storage/image/{$event->image}") }}" alt="...">
                        <div class="slide-info">
                            <div class="slide-type">{{$event->subgenre->name}}</div>
                            <div class="slide-main-info">
                                <h2>{{$event->name}}</h2>
                                <span>{{$event->place->name}} •</span>
                                <span>{{$event->formattedDate}}</span>
                            </div>
                            <a class="slide-event-btn" href="{{ route('event.show', $event->id) }}">Купить</a>
                        </div>
                    </div>
                    @endforeach
                    @foreach($firstEvent as $event)
                    <div class="slide">
                        <img class="slider-img" src="{{ asset("storage/image/{$event->image}") }}" alt="...">
                        <div class="slide-info">
                            <div class="slide-type">{{$event->subgenre->name}}</div>
                            <div class="slide-main-info">
                                <h2>{{$event->name}}</h2>
                                <span>{{$event->place->name}} •</span>
                                <span>{{$event->formattedDate}}</span>
                            </div>
                            <a class="slide-event-btn" href="{{ route('event.show', $event->id) }}">Купить</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <a class="prev-slide"><img src="{{ asset("storage/image/ic_prev.png") }}" alt=""></a>
            <a class="next-slide"><img src="{{ asset("storage/image/ic_next.png") }}" alt=""></a>
    </div>
</section>
<section class="events-coming-sec">
    <div class="container">
        <a class="events-coming-h">
            @if($genre->id == 1)
            <h2>Концерты в вашем городе</h2>
            @elseif($genre->id == 2)
            <h2>Театр в вашем городе</h2>
            @elseif($genre->id == 3)
            <h2>Кино в вашем городе</h2>
            @elseif($genre->id == 4)
            <h2>Стендап в вашем городе</h2>
            @elseif($genre->id == 5)
            <h2>Спорт в вашем городе</h2>
            @endif
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
        <div class="pagination">{{ $events->links() }}</div>
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
<script src="{{ asset('js/main_slider.js') }}"></script>
@endsection('content')