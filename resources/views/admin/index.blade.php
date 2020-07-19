@extends('layouts.app')

@section('content')
    <div class="text-center mb-3">
        <h1>データ追加ページ</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <p>{!! link_to_route('category','カテゴリー追加',[],['class' => 'btn btn-success']) !!}</p>
            <p>{!! link_to_route('variety','品種追加',[],['class' => 'btn btn-success']) !!}</p>
            <p>{!! link_to_route('candidate','候補追加',[],['class' => 'btn btn-success']) !!}</p>
            <p>{!! link_to_route('candidatephoto','候補写真追加',[],['class' => 'btn btn-success']) !!}</p>
            <p>{!! link_to_route('place','地域追加',[],['class' => 'btn btn-success']) !!}</p>
        </div>
    </div>
@endsection