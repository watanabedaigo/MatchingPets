@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}さんのお気に入り一覧</h1>
    <p>お気に入り数　{{ $user->favorites_count }}</p>
    
    @if(count($favorites) > 0)
        @foreach($favorites as $favorite)
        <div class="border border-primary mb-2">
            <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $favorite->id], ['class' => 'btn btn-primary']) !!}</p>
            {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                {!! Form::submit('お気に入りから外す', ['class' => "btn btn-danger"]) !!}
            {!! Form::close() !!}
            <div class="row">
                <div class="col-4">
                    @foreach($candidatephotos as $candidatephoto)
                        @if ($candidatephoto->candidate_id == $favorite->id)
                        <img src="{{ $candidatephoto->image_path }}">
                        @endif
                    @endforeach
                </div>
                <div class="col-6">
                    <p class="mb-0">{{ $favorite->price }}</p>
                    <p class="mb-0">{{ $favorite->age }}</p>
                    <p class="mb-0">{{ $favorite->gender }}</p>
                    <p class="mb-0">{{ $favorite->personality }}</p>
                    <p class="mb-0">{{ $favorite->inspection }}</p>
                    <p class="mb-0">{{ $favorite->place_name }}</p>
                    <p class="mb-0">{{ $favorite->place_address }}</p>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    
@endsection