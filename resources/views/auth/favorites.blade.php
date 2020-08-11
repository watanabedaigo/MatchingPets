@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}さんのお気に入り一覧</h1>
    <p>お気に入り数　{{ $user->favorites_count }}</p>
    
    @if(count($favorites) > 0)
        @foreach($favorites as $favorite)
        <!--<div class="border border-primary mb-2">-->
        <!--    <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $favorite->id], ['class' => 'btn btn-primary']) !!}</p>-->
        <!--    {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}-->
        <!--        {!! Form::submit('お気に入りから外す', ['class' => "btn btn-danger"]) !!}-->
        <!--    {!! Form::close() !!}-->
        <!--    <div class="row">-->
        <!--        <div class="col-4">-->
        <!--            @foreach($candidatephotos as $candidatephoto)-->
        <!--                @if ($candidatephoto->candidate_id == $favorite->id)-->
        <!--                    <img src="{{ $candidatephoto->image_path }}">-->
        <!--                    @break-->
        <!--                @endif-->
        <!--            @endforeach-->
        <!--        </div>-->
        <!--        <div class="col-6">-->
        <!--            <p class="mb-0">{{ $favorite->price }}</p>-->
        <!--            <p class="mb-0">{{ $favorite->age }}</p>-->
        <!--            <p class="mb-0">{{ $favorite->gender }}</p>-->
        <!--            <p class="mb-0">{{ $favorite->personality }}</p>-->
        <!--            <p class="mb-0">{{ $favorite->inspection }}</p>-->
        <!--            <p class="mb-0">{{ $favorite->place_name }}</p>-->
        <!--            <p class="mb-0">{{ $favorite->place_address }}</p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
            <div style='position:relative; z-index:1' class="mb-1 border border-primary ml-3 pl-0">
                <a href="{{ route('candidate.show', $favorite->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                    {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                {!! Form::close() !!}
    
                @if($favorite->coupon != NULL)
                    <a href="{{ route('candidate.coupon', $favorite->id) }}" style='position: relative; z-index:3' class="btn btn-warning">クーポン使用</a>
                @endif
                <div class="row">
                    <div class="col-4">
                        @foreach($candidatephotos as $candidatephoto)
                            @if ($candidatephoto->candidate_id == $favorite->id)
                                <img src="{{ $candidatephoto->image_path }}" class="d-block mx-auto">
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="col-6">
                        <p class="mb-0">値段　　：{{ $favorite->price }}</p>
                        <p class="mb-0">年齢　　：{{ $favorite->age }}</p>
                        <p class="mb-0">性別　　：{{ $favorite->gender }}</p>
                        <p class="mb-0">性格　　：{{ $favorite->personality }}</p>
                        <p class="mb-0">検査　　：{{ $favorite->inspection }}</p>
                        <p class="mb-0">飼育場所：{{ $favorite->place_name }}</p>
                        <p class="mb-0">住所　　：{{ $favorite->place_address }}</p>
                        <p class="mb-0">クーポン：{{ $favorite->coupon }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    
@endsection