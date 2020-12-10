@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">{{ session('message') }}</li>
    </ul>
    @endif
                                
<!--トップページ写真、フリーワード検索-->
    <div class="m-0" style="position:relative;">
        <p class="catchcopy small pl-1 pr-1 m-0 text-center">新しい家族に出会える<br>ペットポータルサイト</p>
        @php
            $total = 0;
            foreach($categories as $category){
                $varieties = $category->varieties()->get();
                foreach($varieties as $variety){
                    $candidates = $variety->candidates()->get();
                    $count = count($candidates);
                    $total += $count;
                }
            }
        @endphp
        <p class="publication small pl-1 pr-1 m-0 text-center"><i class="fas fa-thumbtack thumbtack-1"></i><i class="fas fa-thumbtack thumbtack-2"></i>現在<span class="count"> {{ $total }}</span>匹 掲載中</p>
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
    <div>
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>カテゴリー</h5>
        <div class="category-container row pt-0 pr-2 pl-2 pb-2">
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="col-sm-2 col-3 p-0 mb-1">
                        <div class="category bg-white border-dark border rounded pt-1 mr-1 background-2">
                            @if(Auth::guard('admin')->check())
                                <p class="m-0 text-center w-100 font-weight-bold" style="font-size:3vw;">{{ $category->id }}.{{ $category->name }}</p>
                                <a href="{{ route('category.edit', $category->id) }}" style='position:absolute; z-index:3; top:35px; left:0;' class="btn btn-primary d-inline">編集</a>
                                {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['style'=>'position:absolute; z-index:3; top:70px; left:0;','class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            @else
                                <p class="m-0 text-center w-100 font-weight-bold" style="font-size:3vw;">{{ $category->name }}</p>
                            @endif
                                
                            @foreach($categoryphotos as $categoryphoto)
                                @if ($categoryphoto->category_id == $category->id)
                                    <img src="{{ $categoryphoto->image_path }}" class="d-block img-fluid mx-auto" style="max-width:80%;">
                                @endif
                            @endforeach
                    
                            <a href="{{ route('category.show', $category->id,) }}" class="link"></a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    
<!--人気の品種-->
    <div style="background-color:floralwhite;">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>人気の品種</h5>
        <div class="category-container pb-2">
        @if(count($popularityvarieties) > 0)
            @foreach($popularityvarieties as $popularityvariety)
                <div class="popularityvariety border border-dark rounded row p-0 mx-auto mt-1 background-1" style="width:90%;">
                    <div class="w-100 small">
                        @if(Auth::guard('admin')->check())
                            <p class="m-0 pl-1 font-weight-bold"><nobr><span style="color:tomato;">{{ $loop->index + 1}}位</span> {{ $popularityvariety->id }}.{{ $popularityvariety->name }}({{ count($popularityvariety->candidates()->get()) }}匹掲載中) {{ $popularityvariety->view_count }}</nobr></p>
                        @else
                            <p class="m-0 pl-1 font-weight-bold"><nobr><span style="color:tomato;">{{ $loop->index + 1}}位</span> {{ $popularityvariety->name }}({{ count($popularityvariety->candidates()->get()) }}匹掲載中)</nobr></p>
                        @endif
                    </div>
                        
                    <div class="col-4 pt-1 pb-1 pr-1 small">
                        @if(Auth::guard('admin')->check())
                            <a href="{{ route('variety.edit', $popularityvariety->id) }}" style='position:absolute; z-index:3; top:35px; left:0;' class="btn btn-primary d-inline">編集</a>
                            {!! Form::model($popularityvariety, ['route' => ['variety.destroy', $popularityvariety->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['style'=>'position:absolute; z-index:3; top:70px; left:0;','class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @endif
                            
                        @foreach($popularityvarietyphotos as $popularityvarietyphoto)
                            @if ($popularityvarietyphoto->variety_id == $popularityvariety->id)
                                <img src="{{ $popularityvarietyphoto->image_path }}" class="d-block img-fluid mx-auto" style="max-width:80%;">
                                @break
                            @endif
                        @endforeach
                    </div>
                        
                    <div class="col-8 m-0 small">
                        <p class="m-0 w-100" style="word-wrap: break-word;">{{ $popularityvariety->feature }}</p>
                    </div>
                        
                    <a href="{{ route('variety.show', $popularityvariety->id,) }}" class="link"></a>
                </div>
            @endforeach
        @endif
        </div>
    </div>

<!--新着情報-->
    <div>
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>新着情報</h5>
        <div class="category-container pb-2">
            @if(count($newcandidates) > 0)
                @foreach($newcandidates as $newcandidate)
                    @php
                        $createdAt = $newcandidate->created_at;
                        $date = new DateTime($createdAt);
                        $price = $newcandidate->price;
                        $priceShow = number_format($price);
                    @endphp
    
                    <div class="popularityvariety bg-white border border-dark rounded row p-0 mx-auto mt-1 background-2" style="width:90%;">
                        @if(Auth::guard('admin')->check())
                            <a href="{{ route('candidate.edit', $newcandidate->id) }}" style='position:absolute; z-index:3; top:35px; left:0;' class="btn btn-primary d-inline">編集</a>
                            {!! Form::model($newcandidate, ['route' => ['candidate.destroy', $newcandidate->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['style'=>'position:absolute; z-index:3; top:70px; left:0;','class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @elseif(Auth::guard('web')->check())
                            @if(Auth::user()->is_favorite($newcandidate->id))
                                {!! Form::open(['route' => ['favorites.unfavorite', $newcandidate->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['favorites.favorite', $newcandidate->id]]) !!}
                                    {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                                {!! Form::close() !!}               
                            @endif
                        @endif
                        
                        <div class="w-100 small">
                            @if($newcandidate->view_count == 0)
                                <p class="m-0 pl-1">{{ $date->format('Y年m月d日') }}追加　<span class="font-weight-bold" style="color:tomato;">NEW!!!</span></p>
                            @else
                                <p class="m-0 pl-1">{{ $date->format('Y年m月d日') }}追加　{{ $newcandidate->view_count }}人が見ました</p>
                            @endif
                        </div>
    
                        <div class="col-5 pt-1 pb-1 pl-2 pr-2 text-center d-flex align-items-center">
                            @foreach($newcandidatephotos as $newcandidatephoto)
                                @if ($newcandidatephoto->candidate_id == $newcandidate->id)
                                    <img src="{{ $newcandidatephoto->image_path }}" class="img-fluid">
                                    @break
                                @endif
                            @endforeach
                        </div>
                        <div class="col-7 m-0 p-0 small">
                            @if(Auth::guard('admin')->check())
                                <p class="mb-0">id　　  ：{{ $newcandidate->id }}</p>
                            @endif
                            @foreach($getnames as $getname)
                                @if($getname->id == $newcandidate->variety_id)
                                    <p class="mb-0">品種：{{ $getname->name }}</p>
                                @endif
                            @endforeach
                            <p class="mb-0">値段：{{ $priceShow }}円(税込)</p>
                            <p class="mb-0">誕生日：{{ $newcandidate->birthday }}</p>
                            <p class="mb-0">性別：{{ $newcandidate->gender }}</p>
                            <p class="mb-0">性格：{{ $newcandidate->personality }}</p>
                            <p class="mb-0">場所：{{ $newcandidate->place_name }}</p>
                        </div>
                    
                        <a href="{{ route('candidate.show', $newcandidate->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

     {{-- 管理者ログインページへのリンク --}}
     <a class="nav-item">{!! link_to_route('admin.showlogin', '管理者ログイン', [], ['class' => 'nav-link']) !!}</a>

@endsection