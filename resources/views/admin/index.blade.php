@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>データ追加</h5>
        <div class="category-container pt-0 pr-2 pl-2">
            <div class="mb-1">
                <p class="m-0">カテゴリー</p>
                <p class="m-0 d-inline-block">{!! link_to_route('category','カテゴリー追加',[],['class' => 'btn link-btn']) !!}</p>
                <p class="m-0 d-inline-block">{!! link_to_route('categoryphoto','写真追加',[],['class' => 'btn link-btn']) !!}</p>
            </div>
            
            <div class="mb-1">
                <p class="m-0">品種</p>
                <p class="mb-0 d-inline-block">{!! link_to_route('variety','品種追加',[],['class' => 'btn link-btn']) !!}</p>
                <p class="m-0 d-inline-block">{!! link_to_route('varietyphoto','写真追加',[],['class' => 'btn link-btn']) !!}</p>
            </div>
            
            <div>
                <p class="m-0">候補</p>
                <p class="mb-0 d-inline-block">{!! link_to_route('candidate','候補追加',[],['class' => 'btn link-btn']) !!}</p>
                <p class="m-0 d-inline-block">{!! link_to_route('candidatephoto','写真追加',[],['class' => 'btn link-btn']) !!}</p>
    　　　　</div>
        </div>
    </div>
@endsection