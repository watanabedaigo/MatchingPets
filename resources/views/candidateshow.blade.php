@extends('layouts.app')

@section('content')
    <!--タイトル-->
    @foreach($varieties as $variety)
        @if($variety->id == $candidate->variety_id)
            @foreach($categories as $category)
                @if($category->id == $variety->category_id)
                    <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i><a href="{{ route('category.show', $category->id,) }}" style="color:black; text-decoration:none;">{{ $category->name }}</a> > {{ $variety->name }}</h5>
                @endif
            @endforeach
        @endif
    @endforeach
    
    <!--候補詳細-->
    <div class="category-container row pt-0 pl-2 pr-2">
        <div class="popularityvariety bg-white border border-dark rounded row p-0 mx-auto mt-1 background-2" style="width:95%;">
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
        
            <div class="col-sm-4 bg-light">
                @foreach($candidatephotos as $candidatephoto)
                    @if ($candidatephoto->candidate_id == $candidate->id)
                        <!--最初のループか否かで場合分け-->
                        @if($loop->first)
                            <img src="{{ $candidatephoto->image_path }}" class="d-block mx-auto">
                        @else
                            <img src="{{ $candidatephoto->image_path }}" class="d-inlene-block mx-auto col-4">
                        @endif
                    @endif
                @endforeach
            </div>
            
            <div class="col-sm-6">
                @if(Auth::guard('admin')->check())
                    <p class="mb-0">id　　：{{ $candidate->id }}</p>
                @endif
                <p class="mb-0">閲覧数　：{{ $candidate->view_count }}</p>
                <p class="mb-0">値段　　：{{ $candidate->price }}</p>
                <p class="mb-0">年齢　　：{{ $candidate->age }}</p>
                <p class="mb-0">誕生日　：{{ $candidate->birthday }}</p>
                <p class="mb-0">性別　　：{{ $candidate->gender }}</p>
                <p class="mb-0">性格詳細：{{ $candidate->personality_details }}</p>
                <p class="mb-0">検査　　：{{ $candidate->inspection }}</p>
                <p class="mb-0">飼育場所：{{ $candidate->place_name }}</p>
                <p class="mb-0">住所　　：{{ $candidate->place_address }}</p>
                <p class="mb-0">電話番号：{{ $candidate->place_phonenumber }}</p>
                <p class="mb-0">営業時間：{{ $candidate->bussinesshours }}</p>
                <p class="mb-0">URL     ：<a href ={{ $candidate->URL }}>HPに飛ぶ</a></p>
                <p class="mb-0">クーポン：{{ $candidate->coupon }}</p>
            </div>
            
            <div class="ml-3">
                {!! $candidate->map !!}
            </div>
    
            @if($candidate->coupon != NULL)
                <p>{!! link_to_route('candidate.coupon','クーポンを使う', ['id' => $candidate->id], ['class' => 'btn btn-warning']) !!}</p>
            @endif
        </div>
    </div>
@endsection