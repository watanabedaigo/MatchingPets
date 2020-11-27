@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">{{ session('message') }}</li>
    </ul>
    @endif

<!--トップページ写真、フリーワード検索-->
    <div class="m-0" style="position:relative;">
        <p class="catchcopy small">新しい家族を見つけよう。<br>Find your favorite pet.</p>
        <img src="image/toppage.jpg" class="top-image"></img>
        <div class="search"> 
            <div class="form-group mb-0">
                {!! Form::open(['route' => 'variety.search', 'method' => 'GET']) !!}
                    {!! Form::text('name', null, ['placeholder' =>  '品種を入力','class' => 'form-control d-inline search-form']) !!}
                    {!! Form::submit('検索', ['class' => 'btn btn-secondary search-btn']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
<!--カテゴリー一覧-->
    <div style="background-color:#ffffe0;">
        <h5 class="pt-2 ml-2 mr-2 border-bottom border-dark">カテゴリー</h5>
        <div class="category-container row d-flex justify-content-between p-1">
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    
                    <!--@php-->
                    <!--    $varieties = $category->varieties()->get();-->
                    <!--    $total = 0;-->
                    <!--    foreach($varieties as $variety){-->
                    <!--        $candidates = $variety->candidates()->get();-->
                    <!--        $count = count($candidates);-->
                    <!--        $total = $total + $count;-->
                    <!--    }-->
                    <!--@endphp-->
                
                    <div class="category col-2 bg-white border-dark border rounded-circle">
                        @if(Auth::guard('admin')->check())
                            <p class="category-name m-0 text-center w-100 font-weight-bold">{{ $category->id }}.{{ $category->name }}</p>
                            <a href="{{ route('category.edit', $category->id) }}" style='position:absolute; z-index:3; top:35px; left:0;' class="btn btn-primary d-inline">編集</a>
                            {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['style'=>'position:absolute; z-index:3; top:70px; left:0;','class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @else
                            <p class="category-name m-0 text-center w-100 font-weight-bold">{{ $category->name }}</p>
                        @endif
                            
                        @foreach($categoryphotos as $categoryphoto)
                            @if ($categoryphoto->category_id == $category->id)
                                <img src="{{ $categoryphoto->image_path }}" class="d-block img-fluid">
                            @endif
                        @endforeach

                        <a href="{{ route('category.show', $category->id,) }}" class="link"></a>
                    </div>
                @endforeach
            @endif

            @if(count($categories) <= 12)
                @for ($i = 1; $i <= 12-count($categories); $i++)
                    <div class="category col-2 p-0 text-white">
                        {{ $i }}
                    </div>
                @endfor
            @endif
        </div>
    </div>
    
<!--人気の品種-->
    <div style="background-color:#fffafa;>
        <h5 class="pt-2 ml-2 mr-2 border-bottom border-dark">人気の品種</h5>
        <div class="category-container">
        @if(count($popularityvarieties) > 0)
            @foreach($popularityvarieties as $popularityvariety)
                @if($loop->iteration <= 4)
                    <div class="popularityvariety bg-white border border-dark rounded row p-0 mx-auto mb-1" style="width:90%;">
                        <div class="col-4 pt-1 pb-1 pr-1">
                            @if(Auth::guard('admin')->check())
                                <p class="m-0 text-center small font-weight-bold"><nobr>{{ $popularityvariety->id }}.{{ $popularityvariety->name }}({{ count($popularityvariety->candidates()->get()) }})</nobr></p>
                            @else
                                <p class="m-0 text-center small font-weight-bold"><nobr>{{ $popularityvariety->name }}({{ count($popularityvariety->candidates()->get()) }})</nobr></p>
                            @endif
                            
                            @if(Auth::guard('admin')->check())
                                <a href="{{ route('variety.edit', $popularityvariety->id) }}" style='position:absolute; z-index:3; top:35px; left:0;' class="btn btn-primary d-inline">編集</a>
                                {!! Form::model($popularityvariety, ['route' => ['variety.destroy', $popularityvariety->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['style'=>'position:absolute; z-index:3; top:70px; left:0;','class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            @endif
                            
                            @foreach($popularityvarietyphotos as $popularityvarietyphoto)
                                @if ($popularityvarietyphoto->variety_id == $popularityvariety->id)
                                    <img src="{{ $popularityvarietyphoto->image_path }}" class="d-block img-fluid m-0 mx-auto" style="max-width:80%;">
                                    @break
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="col-8 small m-0 p-0 d-flex align-items-center">
                            <nobr>{!! $popularityvariety->feature !!}</nobr>
                        </div>
                        
                        <a href="{{ route('variety.show', $popularityvariety->id,) }}" class="link"></a>
                    </div>
                @endif
            @endforeach
        @endif
        </div>
    </div>

<!--新着情報-->
    <div style="background-color:#ffffe0;>
        <h5 class="pt-2 ml-2 mr-2 border-bottom border-dark">新着情報</h5>
        <div class="row d-flex justify-content-between" style="margin-left:auto; margin-right: auto; align:center;">
        @if(count($newcandidates) > 0)
            @foreach($newcandidates as $newcandidate)
                @if($loop->iteration <= 5)
                <div style='position:relative; z-index:1; width:19.5%; overflow: hidden;' class="border border-primary pl-0 rounded">
                    <a href="{{ route('candidate.show', $newcandidate->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('candidate.edit', $newcandidate->id) }}" style='position:absolute; z-index:3; top:35px; left:0;' class="btn btn-primary d-inline">編集</a>
                        {!! Form::model($newcandidate, ['route' => ['candidate.destroy', $newcandidate->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['style'=>'position:absolute; z-index:3; top:70px; left:0;','class' => 'btn btn-primary']) !!}
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
                    
                    <div>
                        {{ $newcandidate->created_at }}
                    </div>
                    <div>
                        @foreach($newcandidatephotos as $newcandidatephoto)
                            @if ($newcandidatephoto->candidate_id == $newcandidate->id)
                                <img src="{{ $newcandidatephoto->image_path }}" class="d-block mx-auto" style="width:100%; height:160px;">
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
                    @if($newcandidate->coupon != NULL)
                        <a href="{{ route('candidate.coupon', $newcandidate->id) }}" style='position: relative; z-index:3' class="btn btn-warning">クーポン使用</a>
                    @endif
                </div>
                @endif
            @endforeach
        @endif
        </div>
    </div>
    
     {{-- 管理者ログインページへのリンク --}}
     <a class="nav-item">{!! link_to_route('admin.showlogin', '管理者ログイン', [], ['class' => 'nav-link']) !!}</a>
    
@endsection