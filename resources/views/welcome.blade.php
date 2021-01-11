@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">{{ session('message') }}</li>
    </ul>
    @endif
                                
<!--トップページ写真、フリーワード検索-->
    <div class="m-0" style="position:relative;" id="img">
        <div style="position:relative;">
            <p class="catchcopy small p-1 text-center d-inline-block w-50">新しい家族に出会える<br>ペットポータルサイト</p>
            <img src="{{ asset('/image/toppage.jpg') }}" class="top-image"></img>
        </div>
        
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
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>カテゴリー</h5>
        
        <div class="row pt-0 pb-2 pl-2 pr-2 mx-auto">
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="col-lg-1 col-md-2 col-3 p-0 mb-1">
                        <div class="content bg-white border-dark border rounded pt-1 mr-1 background-2 small">
                            <p class="m-0 text-center w-100 font-weight-bold" id="category-name">
                                @if(Auth::guard('admin')->check())
                                    {{ $category->id }}.
                                @endif
                                {{ $category->name }}
                            </p>
                                
                            @foreach($categoryphotos as $categoryphoto)
                                @if ($categoryphoto->category_id == $category->id)
                                    <img src="{{ $categoryphoto->image_path }}" class="d-block img-fluid mx-auto p-2" style="max-width:80%;">
                                @endif
                            @endforeach
                    
                            <a href="{{ route('category.show', $category->id,) }}" class="link"></a>
                        </div>
                        
                        @if(Auth::guard('admin')->check())
                            <div class="d-flex justify-content-center" style="height:1rem;">
                                <a href="{{ route('category.edit', $category->id) }}" class="d-inline-block"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                                {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                                    {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    
<!--人気の品種-->
    <div style="background-color:floralwhite;">
        <div class="container">
            <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>人気の品種</h5>
            
            <div class="pr-2 pb-2 pl-2 mx-auto" id="popularityvariety-wrap">
            @if(count($popularityvarieties) > 0)
                @foreach($popularityvarieties as $popularityvariety)
                    <div class="content border border-dark rounded row p-2 mt-1 mx-auto background-1" id="popularityvariety">
                        <div class="w-100 small">
                            @if(Auth::guard('admin')->check())
                                <p class="m-0 pl-1 font-weight-bold"><nobr><span style="color:tomato;">{{ $loop->index + 1}}位</span> {{ $popularityvariety->id }}.{{ $popularityvariety->name }}({{ count($popularityvariety->candidates()->get()) }}匹掲載中) {{ $popularityvariety->view_count }}回閲覧</nobr></p>
                            @else
                                <p class="m-0 pl-1 font-weight-bold"><nobr><span style="color:tomato;">{{ $loop->index + 1}}位</span> {{ $popularityvariety->name }}({{ count($popularityvariety->candidates()->get()) }}匹掲載中)</nobr></p>
                            @endif
                        </div>
                        
                        <div class="col-lg-12 col-4 pt-lg-2 pb-lg-2 p-0 small d-flex align-items-center">
                            @foreach($popularityvarietyphotos as $popularityvarietyphoto)
                                @if ($popularityvarietyphoto->variety_id == $popularityvariety->id)
                                    <img src="{{ $popularityvarietyphoto->image_path }}" class="d-block img-fluid mx-auto" id="popularityvariety-img">
                                    @break
                                @endif
                            @endforeach
                        </div>
                            
                        <div class="col-lg-12 col-8 m-0 p-0 small">
                            <p class="m-0 w-100" style="word-wrap: break-word;">{{ $popularityvariety->feature }}</p>
                        </div>
                        
                        @if(Auth::guard('admin')->check())
                            <div class="admin">
                                <a href="{{ route('variety.edit', $popularityvariety->id) }}" class="d-inline-block h-100"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                                {!! Form::model($popularityvariety, ['route' => ['variety.destroy', $popularityvariety->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                                    {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                            
                        <a href="{{ route('variety.show', $popularityvariety->id,) }}" class="link"></a>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
    </div>

<!--新着情報-->
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>新着情報</h5>
        
        <div class="pr-2 pb-3 pl-2 mx-auto row no-gutters">
            @if(count($newcandidates) > 0)
                @foreach($newcandidates as $newcandidate)
                    @php
                        $createdAt = $newcandidate->created_at;
                        $date = new DateTime($createdAt);
                        $price = $newcandidate->price;
                        $priceShow = number_format($price);
                    @endphp
                    
                    <div class="col-lg-10 col-12 content bg-white border border-dark rounded row p-0 mx-auto mt-1 background-2">
                        <div class="w-100 small">
                            @if($newcandidate->view_count == 0)
                                <p class="m-0 pl-1">{{ $date->format('Y年m月d日') }}追加　<span class="font-weight-bold" style="color:tomato;">NEW!!!</span></p>
                            @else
                                <p class="m-0 pl-1">{{ $date->format('Y年m月d日') }}追加　{{ $newcandidate->view_count }}人が見ました</p>
                            @endif
                        </div>
        
                        <div class="col-5 p-2 text-center d-flex align-items-center">
                            @foreach($newcandidatephotos as $newcandidatephoto)
                                @if ($newcandidatephoto->candidate_id == $newcandidate->id)
                                    <img src="{{ $newcandidatephoto->image_path }}" class="img-fluid d-inline-block mx-auto newcandidate-img">
                                    @break
                                @endif
                            @endforeach
                        </div>
                            
                        <div class="col-7  m-0 p-md-3 p-1 small">
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
                        
                        @if(Auth::guard('admin')->check())
                            <div class="admin">
                                <a href="{{ route('candidate.edit', $newcandidate->id) }}" class="d-inline-block h-100"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                                {!! Form::model($newcandidate, ['route' => ['candidate.destroy', $newcandidate->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                                    {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                                {!! Form::close() !!}
                            </div>
                        @elseif(Auth::guard('web')->check())
                            @if(Auth::user()->is_favorite($newcandidate->id))
                                <div class="favorite">
                                    {!! Form::open(['route' => ['favorites.unfavorite', $newcandidate->id], 'method' => 'delete']) !!}
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn p-0 removefavorite' , 'style' => 'color:crimson;'] ) !!}
                                    {!! Form::close() !!}
                                </div>
                            @else
                                <div class="favorite">
                                    {!! Form::open(['route' => ['favorites.favorite', $newcandidate->id]]) !!}
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn p-0 addfavorite'] ) !!}
                                    {!! Form::close() !!}  
                                </div>
                            @endif
                        @endif
                            
                        <a href="{{ route('candidate.show', $newcandidate->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    {{-- 管理者ログインページへのリンク --}}
    <p class="text-center m-0">{!! link_to_route('admin.showlogin', '管理者ログイン', [],['style' => 'text-decoration:none;']) !!}</p>
@endsection