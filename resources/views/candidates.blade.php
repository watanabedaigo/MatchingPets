@extends('layouts.app')

@section('content')
    <h1>候補一覧</h1>
    {{ $variety->name }}
     @if(count($candidates) > 0)
        @foreach($candidates as $candidate)
        <div class="border border-primary">
            @if(Auth::guard('admin')->check())
                <p class="mb-0">{!! link_to_route('top','編集', [], ['class' => 'btn btn-warning']) !!}</p>
                <p class="mb-0">{!! link_to_route('top','削除', [], ['class' => 'btn btn-danger']) !!}</p>
            @elseif(Auth::guard('web')->check())
                <p class="mb-0">{!! link_to_route('top','お気に入り', [], ['class' => 'btn btn-success']) !!}</p>
            @endif
            <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $candidate->id], ['class' => 'btn btn-primary']) !!}</p>
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