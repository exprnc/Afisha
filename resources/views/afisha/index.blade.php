@extends('partials.header-footer')
@section('content')
<section class="main-slider-sec">
    <div class="container">
        <div class="slider">
                <div class="slider-line">
                    @foreach($mainSliderEvents as $event)
                    <div class="slide">
                        <img class="slider-img" src="{{ asset("storage/image/{$event->image}") }}">
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
                <h2>События в ближайшие дни</h2>
                <img src="{{ asset("storage/image/ic_arrow_right.png") }}" alt="">
            </a>
            <div class="events-coming-main">
            @foreach($upcomingEvents as $event) 
                <a href="{{ route('event.show', $event->id) }}" class="event-coming">
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
            <div class="pagination">{{ $upcomingEvents->links() }}</div>
        </div>
    </section>
    <section id="top" class="events-top-sec">
        <div class="container">
            <div class="top-events-img"><img src="{{ asset("storage/image/top.png") }}" alt=""></div>
            <div class="top-events-h">СЕЙЧАС ВЫБИРАЮТ</div>
            <div class="top-slider">
                <div class="top-slider-line">
                    @php
                        $iterationCount = 1;
                    @endphp
                    @foreach($favoriteEventsForSlider as $event)
                        @if($iterationCount == 10)
                        <a style="width:325px;" href="{{ route('event.show', $event->id) }}" class="top-slide">
                            <div style="width: 150px;" class="top-count">{{$iterationCount}}</div>
                            <div class="top-slide-img-info">
                                <img src="{{ asset("storage/image/{$event->image}") }}" alt="">
                                <div class="top-slide-info">
                                    <h3>{{$event->name}}</h3>
                                    <span>{{$event->subgenre->name}} ·</span>
                                    <span>{{$event->formattedDate}}</span>
                                </div>
                            </div>
                        </a>
                        @else
                        <a href="{{ route('event.show', $event->id) }}" class="top-slide">
                            <div class="top-count">{{$iterationCount}}</div>
                            <div class="top-slide-img-info">
                                <img src="{{ asset("storage/image/{$event->image}") }}" alt="">
                                <div class="top-slide-info">
                                    <h3>{{$event->name}}</h3>
                                    <span>{{$event->subgenre->name}} ·</span>
                                    <span>{{$event->formattedDate}}</span>
                                </div>
                            </div>
                        </a>
                        @endif
                        @php
                            $iterationCount++;
                        @endphp
                    @endforeach
                </div>
            </div>
            <a class="prev-top-slide"><img src="{{ asset("storage/image/ic_prev.png") }}" alt=""></a>
            <a class="next-top-slide"><img src="{{ asset("storage/image/ic_next.png") }}" alt=""></a>
        </div>
    </section>
    <section class="announ-sec">
        <div class="container">
            <h2>Доска объявлений</h2>
            <div class="announ-container">
                <div class="announ-block"><img src="{{ asset("storage/image/pushkin_card.jpg") }}" alt=""></div>
                <div class="announ-block"><img src="{{ asset("storage/image/pushkin_card.jpg") }}" alt=""></div>
                <div class="announ-block"><img src="{{ asset("storage/image/pushkin_card.jpg") }}" alt=""></div>
                <div class="announ-block"><img src="{{ asset("storage/image/pushkin_card.jpg") }}" alt=""></div>
            </div>
        </div>
    </section>
    <section class="events-coming-sec">
        <div class="container">
            <a class="events-coming-h">
                <h2>Самые ожидаемые концерты</h2>
                <img src="{{ asset("storage/image/ic_arrow_right.png") }}" alt="">
            </a>
            <div class="events-coming-main">
                @foreach($favoriteEvents as $event) 
                <a href="{{ route('event.show', $event->id) }}" class="event-coming">
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
            <div class="pagination">{{ $favoriteEvents->links() }}</div>
        </div>
    </section>
    <section class="genres-sec">
        <div class="container">
            <h2>Жанры</h2>
            <div class="genres-container">
                @foreach($genres as $genre)
                <a href="{{ route('genre.show', $genre->id) }}" class="genres-block">
                    <img src="{{ asset("storage/image/{$genre->image}") }}" alt="">
                    <div class="genres-info">
                        <h3>{{ $genre->name }}</h3>
                        <p>14 событий</p>
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
<script src="js/main_slider.js"></script>
<script src="js/top_slider.js"></script>

@endsection('content')