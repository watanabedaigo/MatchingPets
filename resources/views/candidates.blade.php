@extends('layouts.app')

@section('content')
    <h3>{{ $variety->name }}　候補一覧</h3>
    <p>候補数　{{ $variety->candidates_count }}</p>
    
    <div class="row mb-3">
        <div class="col-3">
        <span>記載日</span>
        {!! link_to_route('candidate.created_at_desc','新', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('candidate.created_at_asc','古', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        </div>
        <div class="col-3">
        <span>値段</span>
        {!! link_to_route('candidate.price_asc','低', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('candidate.price_desc','高', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}        
        </div>
        <div class="col-3">
        <span>年齢</span>
        {!! link_to_route('candidate.age_asc','低', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('candidate.age_desc','高', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}        
        </div>
    </div>
    
     @if(count($candidates) > 0)
        @foreach($candidates as $candidate)
        <div class="border border-primary mb-2">
            <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $candidate->id], ['class' => 'btn btn-primary']) !!}</p>
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
                <div class="col-4">
                    @foreach($candidatephotos as $candidatephoto)
                        @if ($candidatephoto->candidate_id == $candidate->id)
                        <img src="{{ $candidatephoto->image_path }}" class="d-block mx-auto">
                        @endif
                    @endforeach
                </div>
                <div class="col-6">
                    <p class="mb-0">{{ $candidate->price }}</p>
                    <p class="mb-0">{{ $candidate->age }}</p>
                    <p class="mb-0">{{ $candidate->gender }}</p>
                    <p class="mb-0">{{ $candidate->personality }}</p>
                    <p class="mb-0">{{ $candidate->inspection }}</p>
                    <p class="mb-0">{{ $candidate->place_name }}</p>
                    <p class="mb-0">{{ $candidate->place_address }}</p>
                </div>
            </div>
        </div>
        @endforeach
    @endif
@endsection