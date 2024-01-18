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
        <div class="my-tickets-main">
            @if($tickets->isEmpty()) 
            <div class="empty-mess">Здесь пока пусто</div> 
            @endif
            @foreach($tickets as $ticket)
            <div class="my-ticket">
                <div class="my-ticket-date"><img src="{{ asset("storage/image/ic_date2.png") }}" alt=""><span>{{$ticket->event->formattedDate}} • {{$ticket->event->formattedTime}}</span></div>
                <div class="my-ticket-img"><img src="{{ asset("storage/image/{$ticket->event->image}") }}" alt=""></div>
                <div class="my-ticket-h">{{$ticket->event->name}}</div>
                <div class="my-ticket-location"><img src="{{ asset("storage/image/ic_location2.png") }}" alt=""><a href="{{ route('place.show', $ticket->event->place) }}">{{$ticket->event->place->name}}</a></div>
                <div class="my-ticket-1-circle"></div>
                <div class="my-ticket-2-circle"></div>
                <div class="my-ticket-3-circle"></div>
                <div class="my-ticket-4-circle"></div>
                <form action="{{ route('ticket.delete', $ticket->event->id) }}" method="POST">
                    @csrf
                    <button class="my-ticket-return" type="submit">Возврат</a>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection('content')