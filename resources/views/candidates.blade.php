@extends('layouts.app')

@section('content')
    @if(count($candidates) < 1)
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">該当する候補がいませんでした。申し訳ないのですが、条件を変えて再度検索をお願い致します。</li>
    </ul>
    @endif

    <h3>{{ $variety->name }}　候補一覧</h3>
    
    <p class="mb-1">{{ $variety->name }}の飼育上の注意</p>
    <div class="border border-primary mb-2">
        <div class="col-2 d-inline-block">
            <p class="mb-0">特徴</p>
            <p class="mb-0">{{ $variety->feature }}</p>
        </div>
        <div class="col-2 d-inline-block">
            <p class="mb-0">平均寿命</p>
            <p class="mb-0">{{ $variety->lifespan }}</p>
        </div>
        <div class="col-2 d-inline-block">
            <p class="mb-0">必要な道具</p>
            <p class="mb-0">{{ $variety->breedingtool }}</p>
        </div>
        <div class="col-2 d-inline-block">
            <p class="mb-0">費用</p>
            <p class="mb-0">{{ $variety->cost }}</p>
        </div>
    </div>

    <p class="mb-1">候補絞り込み</p>
    {!! Form::open(['route' => 'candidate.narrowing', 'method' => 'GET']) !!}
        @if(Auth::guard('admin')->check())
            <div class="form-group border border-warning mb-2 pt-1"  style="height: 90px;">
        @else
            <div class="form-group border border-warning mb-2 pt-1"  style="height: 50px;">
        @endif
            {!! Form::label('place_address', '場所:') !!}
            {!! Form::text('place_address', old('place_address'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control col-2 d-inline-block mr-3']) !!}
                    
            {!! Form::label('gender', '性別:') !!}
            <!--{!! Form::select('gender',['オス'=>'オス','メス'=>'メス'], null, ['placeholder' => '性別を選択','class' => 'form-control']) !!}-->
            <span>オス </span>{!! Form::radio('gender', 'オス') !!}
            <span>メス </span>{!! Form::radio('gender', 'メス') !!}
                    
            {!! Form::label('age', '年齢:',['class' => 'ml-3']) !!}
            {!! Form::select('age',['2'=>'2歳以下','4'=>'4歳以下','6'=>'6歳以下','8'=>'8歳以下'], null, ['placeholder' => '上限なし','class' => 'form-control col-2 d-inline-block mr-3']) !!}
                    
            {!! Form::label('price', '値段:') !!}
            {!! Form::select('price',['50000'=>'50000円以下','70000'=>'70000円以下','90000'=>'90000円以下','110000'=>'110000円以下'], null, ['placeholder' => '上限なし','class' => 'form-control col-2 d-inline-block mr-3']) !!}
                    
            {!! Form::label('coupon', 'クーポン有のみ表示:') !!}
            {!! Form::checkbox('coupon','有') !!}
                    
            @if(Auth::guard('admin')->check())
                {!! Form::label('birthday', '誕生日:') !!}
                {!! Form::text('birthday', null, ['placeholder' => '誕生日を入力','class' => 'form-control col-2 d-inline-block']) !!}
            @endif
                    
            {!! Form::hidden('variety_id', $variety->id) !!}
        </div>
        {!! Form::submit('検索', ['class' => 'btn btn-warning col-12']) !!}
    {!! Form::close() !!}
            
    <p class="mt-3">候補数：{{ $candidates->total() }}件中{{ $candidates->count() }}件表示</p>  
    {{ $candidates->links() }}
    
    <div class="row mb-3">
        <div class="col-3">
        <span>記載日</span>
        {!! link_to_route('candidate.created_at_desc','新', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('candidate.created_at_asc','古', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        </div>
        <div class="col-3">
        <span>値段</span>
        {!! link_to_route('candidate.price_asc','低', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('candidate.price_desc','高', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}        
        </div>
        <div class="col-3">
        <span>年齢</span>
        {!! link_to_route('candidate.age_asc','低', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('candidate.age_desc','高', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}        
        </div>
    </div>
    
    @if(count($candidates) > 0)
        @foreach($candidates as $candidate)
        <div class="border border-primary mb-2">
            @if(Auth::guard('admin')->check())
                <p class="mb-0">{!! link_to_route('candidate.show','ID'.$candidate->id.'.'.'候補詳細', ['id' => $candidate->id], ['class' => 'btn btn-primary']) !!}</p>
                <p class="mb-0">{!! link_to_route('candidate.edit', '編集', ['id' => $candidate->id], ['class' => 'btn btn-secondary']) !!}</p>
                {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                {!! Form::close() !!}
            @elseif(Auth::guard('web')->check())
                <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $candidate->id], ['class' => 'btn btn-primary']) !!}</p>
                @if (Auth::user()->is_favorite($candidate->id))
                    {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete']) !!}
                        {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success"]) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['favorites.favorite', $candidate->id]]) !!}
                        {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success"]) !!}
                    {!! Form::close() !!}               
                @endif
            @else
                <p class="mb-0">{!! link_to_route('candidate.show','候補詳細', ['id' => $candidate->id], ['class' => 'btn btn-primary']) !!}</p>
            @endif
            
            @if($candidate->coupon != NULL)
                <p>{!! link_to_route('candidate.coupon','クーポンを使う', ['id' => $candidate->id], ['class' => 'btn btn-warning']) !!}</p>
            @endif
            <div class="row">
                <div class="col-4">
                    @foreach($candidatephotos as $candidatephoto)
                        @if ($candidatephoto->candidate_id == $candidate->id)
                            <img src="{{ $candidatephoto->image_path }}" class="d-block mx-auto">
                            @break
                        @endif
                    @endforeach
                    
                </div>
                <div class="col-6">
                    <p class="mb-0">値段　　：{{ $candidate->price }}</p>
                    <p class="mb-0">年齢　　：{{ $candidate->age }}</p>
                    <p class="mb-0">性別　　：{{ $candidate->gender }}</p>
                    <p class="mb-0">性格　　：{{ $candidate->personality }}</p>
                    <p class="mb-0">検査　　：{{ $candidate->inspection }}</p>
                    <p class="mb-0">飼育場所：{{ $candidate->place_name }}</p>
                    <p class="mb-0">住所　　：{{ $candidate->place_address }}</p>
                    <p class="mb-0">クーポン：{{ $candidate->coupon }}</p>
                </div>
            </div>
        </div>
        @endforeach
    @endif
@endsection