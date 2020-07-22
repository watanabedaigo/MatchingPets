@extends('layouts.app')

@section('content')
    <h1>お気に入り一覧</h1>
    {{ $user->name }}
    @if(count($favorites) > 0)
        @foreach($favorites as $favorite)
        <div class="border border-primary">
            {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                {!! Form::submit('お気に入りから外す', ['class' => "btn btn-danger"]) !!}
            {!! Form::close() !!}
            <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $favorite->id], ['class' => 'btn btn-primary']) !!}</p>
            <p class="mb-0">{{ $favorite->price }}</p>
            <p class="mb-0">{{ $favorite->age }}</p>
            <p class="mb-0">{{ $favorite->gender }}</p>
            <p class="mb-0">{{ $favorite->personality }}</p>
            <p class="mb-0">{{ $favorite->inspection }}</p>
            <p class="mb-0">{{ $favorite->place_name }}</p>
            <p class="mb-0">{{ $favorite->place_address }}</p>
        </div>
        <p></p>
        @endforeach
    @endif
    
@endsection