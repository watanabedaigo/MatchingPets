@extends('layouts.app')

@section('content')
    <h3>候補詳細</h3>
    
    <div class="border border-primary">
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
        
        @if($candidate->coupon != NULL)
                <p>{!! link_to_route('candidate.coupon','クーポンを使う', ['id' => $candidate->id], ['class' => 'btn btn-warning']) !!}</p>
        @endif
        <div class="row">
            <div class="col-4">
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
            <div class="col-6">
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
        </div>
    </div>
@endsection