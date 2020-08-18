@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">{{ session('message') }}</li>
    </ul>
    @endif

<!--トップページ写真、フリーワード検索-->
    <div style="position:relative;">
        <p style="position:absolute; color:black; font-weight:800; font-size:1.7em; top:25%; left:3%;">お気に入りの一匹を見つけよう。<br>Find your favorite pet.</p>
        <img src="image/toppage.jpg" style="width:100%;"></img>
        <div style="position:absolute; top:65%; left:3%; width:40%;"> 
            <div class="form-group">
                {!! Form::open(['route' => 'variety.search', 'method' => 'GET']) !!}
                    {!! Form::text('name', null, ['placeholder' =>  '品種を入力','class' => 'form-control d-inline','style' => 'width:75%;']) !!}
                    {!! Form::submit('検索', ['class' => 'btn btn-secondary d-inline']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
<!--カテゴリー一覧-->
    <h3>カテゴリー一覧</h3>
    <div class="row d-flex justify-content-between" style="margin-left:auto; margin-right: auto; align:center;">
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
                    <div style='position:relative; z-index:1; width:14%; height:150px;' class="mb-1 border border-primary pl-0">
                        <p>ID{{ $category->id }}.{{ $category->name }}({{ $total }})</p>
                        @foreach($categoryphotos as $categoryphoto)
                            @if ($categoryphoto->category_id == $category->id)
                                <img src="{{ $categoryphoto->image_path }}" class="d-block mx-auto" style="width:70%; height:70%;">
                            @endif
                        @endforeach
                        <a href="{{ route('category.show', $category->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                        <a href="{{ route('category.edit', $category->id) }}" style='position:relative; z-index:3 width:40px; color:black;' class="btn d-inline">編集</a>
                        {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}
                    </div>
                @else
                    <div style='position:relative; width:14%; height:150px;' class="mb-1 border border-primary pl-0">
                        <p>{{ $category->name }}({{ $total }})</p>
                        @foreach($categoryphotos as $categoryphoto)
                            @if ($categoryphoto->category_id == $category->id)
                                <img src="{{ $categoryphoto->image_path }}" class="d-block mx-auto"  style="width:70%; height:70%;"> 
                            @endif
                        @endforeach
                        <a href="{{ route('category.show', $category->id) }}" style='position:absolute; top:0; left:0; height:100%; width:100%;'></a>
                    </div>
                @endif

            @endforeach
        @endif
    </div>

<!--新着情報-->
    <h3 class="mt-3">新着情報</h3>
    <div class ="row">
    @if(count($newcandidates) > 0)
        @foreach($newcandidates as $newcandidate)
            @if($loop->iteration < 4)
            <div style='position:relative; z-index:1' class="mb-1 border border-primary col-3 ml-3 pl-0">
                <a href="{{ route('candidate.show', $newcandidate->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                @if(Auth::guard('admin')->check())
                    <a href="{{ route('candidate.edit', $newcandidate->id) }}" style='position: relative; z-index:3' class="btn btn-secondary">編集</a>
                    {!! Form::model($newcandidate, ['route' => ['candidate.destroy', $newcandidate->id], 'method' => 'delete']) !!}
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
                    @if(Auth::guard('admin')->check())
                        <p class="mb-0 text-danger">id　　  ：{{ $newcandidate->id }}</p>
                    @endif
                    <p class="mb-0">閲覧数　：{{ $newcandidate->view_count }}</p>
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
    @endif
    </div>
    
@endsection