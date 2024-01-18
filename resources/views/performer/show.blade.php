@extends('partials.header-footer')
@section('content')
<section class="artist-sec">
    <div class="container">
        <div class="artist-info-block">
            <img src="{{ asset("storage/image/{$performer->photo}") }}" alt="">
            <h2>{{ $performer->name }}</h2>
        </div>
        <div class="artist-concerts-block">
            <div class="artist-concerts-top">
                <h2>{{ $performer->name }} — мероприятия</h2>
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
            <div class="artist-content-info">
                <h2>{{ $performer->name }}</h2>
                <p class="artist-info-text">{{ $performer->description }}</p>
                <a onclick="artistToggleText()" class="expandable-text-a">Развернуть текст</a>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset("js/show_text.js") }}"></script>
@endsection('content')