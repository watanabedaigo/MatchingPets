@extends('layouts.app')

@section('content')
    <h1>候補一覧</h1>
    {{ $variety->name }}
     @if(count($candidates) > 0)
        @foreach($candidates as $candidate)
        <div class="border border-primary">
            {!! link_to_route('candidate.show','候補詳細', ['id' => $candidate->id], ['class' => 'btn btn-primary']) !!}
    
            @if(Auth::guard('admin')->check())
                <p class="mb-0">{!! link_to_route('candidate.edit', '編集', ['id' => $candidate->id], ['class' => 'btn btn-warning']) !!}</p>
                {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @elseif(Auth::guard('web')->check())
                @if (Auth::user()->is_favorite($candidate->id))
                    {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete']) !!}
                        {!! Form::submit('お気に入りから外す', ['class' => "btn btn-danger"]) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['favorites.favorite', $candidate->id]]) !!}
                        {!! Form::submit('お気に入りに追加', ['class' => "btn btn-warning"]) !!}
                    {!! Form::close() !!}
                @endif
            @endif
    
            <p class="mb-0">{{ $candidate->price }}</p>
            <p class="mb-0">{{ $candidate->age }}</p>
            <p class="mb-0">{{ $candidate->gender }}</p>
            <p class="mb-0">{{ $candidate->personality }}</p>
            <p class="mb-0">{{ $candidate->inspection }}</p>
            <p class="mb-0">{{ $candidate->place_name }}</p>
            <p class="mb-0">{{ $candidate->place_address }}</p>
        </div>
        <p></p>
        @endforeach
    @endif
@endsection