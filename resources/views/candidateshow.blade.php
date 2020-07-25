@extends('layouts.app')

@section('content')
    <h1>候補詳細</h1>
    <div class="border border-primary">
        
        @if(Auth::guard('admin')->check())
            <p class="mb-0">{!! link_to_route('candidate.edit', '編集', ['id' => $candidate->id], ['class' => 'btn btn-secondary']) !!}</p>
            {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete']) !!}
                {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
            {!! Form::close() !!}
        @elseif(Auth::guard('web')->check())
            @if (Auth::user()->is_favorite($candidate->id))
                {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete']) !!}
                    {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success"]) !!}
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['favorites.favorite', $candidate->id]]) !!}
                    {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success"]) !!}
                {!! Form::close() !!}               
            @endif
        @endif
            <div class="row">
                <div class="col-5">
                    @foreach($candidatephotos as $candidatephoto)
                        @if ($candidatephoto->candidate_id == $candidate->id)
                        <img src="{{ $candidatephoto->image_path }}">
                        @endif
                    @endforeach
                </div>
                <div class="col-6">
                    <p class="mb-0">{{ $candidate->price }}</p>
                    <p class="mb-0">{{ $candidate->age }}</p>
                    <p class="mb-0">{{ $candidate->gender }}</p>
                    <p class="mb-0">{{ $candidate->personality }}</p>
                    <p class="mb-0">{{ $candidate->personality_details }}</p>
                    <p class="mb-0">{{ $candidate->inspection }}</p>
                    <p class="mb-0">{{ $candidate->place_name }}</p>
                    <p class="mb-0">{{ $candidate->place_address }}</p>
                    <p class="mb-0">{{ $candidate->place_phonenumber }}</p>
                    <p class="mb-0">{{ $candidate->place_bussinesshours }}</p>
                </div>
            </div>
    </div>
@endsection