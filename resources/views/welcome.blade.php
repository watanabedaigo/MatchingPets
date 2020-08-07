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
                
                <div class="mb-1 col-4 border border-primary ml-3 pl-0">
                    @if(Auth::guard('admin')->check())
                        <p class = "mt-0 mb-0">{!! link_to_route('category.show','ID'.$category->id.'.'.$category->name.'('.$total.')', ['id' => $category->id], ['class' => 'btn btn-primary']) !!}</p>
                        <p class="mb-0">{!! link_to_route('category.edit', '編集', ['id' => $category->id], ['class' => 'btn btn-secondary']) !!}</p>
                        {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                        {!! Form::close() !!}
                    @else
                        <p class = "mt-0 mb-0">{!! link_to_route('category.show',$category->name.'('.$total.')', ['id' => $category->id], ['class' => 'btn btn-primary']) !!}</p>
                    @endif
                    
                    @foreach($categoryphotos as $categoryphoto)
                        @if ($categoryphoto->category_id == $category->id)
                        <img src="{{ $categoryphoto->image_path }}" class="d-block mx-auto">
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

    <h3 class="mt-3">新着情報</h3>
    <div class ="row">
        @foreach($newcandidates as $newcandidate)
            @if($loop->iteration < 4)
                <div class="border border-primary mb-2 mr-3 ml-3 col-3 pl-0">
                    <p class="mb-0">追加日時<br>{{ $newcandidate->created_at }}</p>
                    @if(Auth::guard('admin')->check())
                        <p class="mb-0">{!! link_to_route('candidate.show','ID'.$newcandidate->id.'.'.'候補詳細', ['id' => $newcandidate->id], ['class' => 'btn btn-primary']) !!}</p>
                        <p class="mb-0">{!! link_to_route('candidate.edit', '編集', ['id' => $newcandidate->id], ['class' => 'btn btn-secondary']) !!}</p>
                        {!! Form::model($newcandidate, ['route' => ['candidate.destroy', $newcandidate->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                        {!! Form::close() !!}
                    @elseif(Auth::guard('web')->check())
                        <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $newcandidate->id], ['class' => 'btn btn-primary']) !!}</p>
                        @if (Auth::user()->is_favorite($newcandidate->id))
                            {!! Form::open(['route' => ['favorites.unfavorite', $newcandidate->id], 'method' => 'delete']) !!}
                                {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success"]) !!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => ['favorites.favorite', $newcandidate->id]]) !!}
                                {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success"]) !!}
                            {!! Form::close() !!}               
                        @endif
                    @else
                        <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $newcandidate->id], ['class' => 'btn btn-primary']) !!}</p>
                    @endif
                    
                    
                    <div>
                        @foreach($newcandidatephotos as $newcandidatephoto)
                            @if ($newcandidatephoto->candidate_id == $newcandidate->id)
                                <img src="{{ $newcandidatephoto->image_path }}" class="d-block mx-auto">
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="pl-2">
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