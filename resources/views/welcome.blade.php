@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">{{ session('message') }}</li>
    </ul>
    @endif
    
    <h3>品種　フリーワード検索</h3>
    <div class="row"> 
        <div class="form-group col-6">
            {!! Form::open(['route' => 'variety.search', 'method' => 'GET']) !!}
                {!! Form::label('name', '品種名') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! Form::submit('検索', ['class' => 'btn btn-secondary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <h3>カテゴリー一覧</h3>
    <div class="row">
        @if(count($categories) > 0)
            @foreach($categories as $category)
                
                @php
                    $varieties = $category->varieties()->get();
                    $total = 0;
                    foreach($varieties as $variety){
                        $candidates = $variety->candidates()->get();
                        $count = count($candidates);
                        $total = $total + $count;
                    }
                @endphp
                
                @if(Auth::guard('admin')->check())
                    <div style='position:relative; z-index:1' class="mb-1 col-4 border border-primary ml-3 pl-0">
                        <p>ID{{ $category->id }}.{{ $category->name }}({{ $total }})</p>
                        @foreach($categoryphotos as $categoryphoto)
                            @if ($categoryphoto->category_id == $category->id)
                                <img src="{{ $categoryphoto->image_path }}" class="d-block mx-auto">
                            @endif
                        @endforeach
                        <a href="{{ route('category.show', $category->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                        <a href="{{ route('category.edit', $category->id) }}" style='position: relative; z-index:3' class="btn btn-secondary">編集</a>
                        {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary','style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}
                    </div>
                @else
                    <div style='position:relative;' class="mb-1 col-4 border border-primary ml-3 pl-0">
                        <p>{{ $category->name }}({{ $total }})</p>
                        @foreach($categoryphotos as $categoryphoto)
                            @if ($categoryphoto->category_id == $category->id)
                                <img src="{{ $categoryphoto->image_path }}" class="d-block mx-auto">
                            @endif
                        @endforeach
                        <a href="{{ route('category.show', $category->id) }}" style='position:absolute; top:0; left:0; height:100%; width:100%;'></a>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <h3 class="mt-3">新着情報</h3>
    <div class ="row">
        @foreach($newcandidates as $newcandidate)
            @if($loop->iteration < 4)
            <div style='position:relative; z-index:1' class="mb-1 border border-primary col-3 ml-3 pl-0">
                <a href="{{ route('candidate.show', $newcandidate->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                @if(Auth::guard('admin')->check())
                    <a href="{{ route('candidate.edit', $newcandidate->id) }}" style='position: relative; z-index:3' class="btn btn-secondary">編集</a>
                    {!! Form::model($candidate, ['route' => ['candidate.destroy', $newcandidate->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-secondary','style'=>'position:relative; z-index:3']) !!}
                    {!! Form::close() !!}
                @elseif(Auth::guard('web')->check())
                    @if (Auth::user()->is_favorite($newcandidate->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $newcandidate->id], 'method' => 'delete']) !!}
                            {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['favorites.favorite', $newcandidate->id]]) !!}
                            {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}               
                    @endif
                @endif
                
                @if($newcandidate->coupon != NULL)
                    <a href="{{ route('candidate.coupon', $newcandidate->id) }}" style='position: relative; z-index:3' class="btn btn-warning">クーポン使用</a>
                @endif
                <div>
                    @foreach($newcandidatephotos as $newcandidatephoto)
                        @if ($newcandidatephoto->candidate_id == $newcandidate->id)
                            <img src="{{ $newcandidatephoto->image_path }}" class="d-block mx-auto">
                            @break
                        @endif
                    @endforeach
                </div>
                <div>
                    <p class="mb-0">値段　　：{{ $newcandidate->price }}</p>
                    <p class="mb-0">年齢　　：{{ $newcandidate->age }}</p>
                    <p class="mb-0">性別　　：{{ $newcandidate->gender }}</p>
                    <p class="mb-0">性格　　：{{ $newcandidate->personality }}</p>
                    <p class="mb-0">検査　　：{{ $newcandidate->inspection }}</p>
                    <p class="mb-0">飼育場所：{{ $newcandidate->place_name }}</p>
                    <p class="mb-0">住所　　：{{ $newcandidate->place_address }}</p>
                    <p class="mb-0">クーポン：{{ $newcandidate->coupon }}</p>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    
@endsection