@extends('layouts.app')

@section('content')
    @if(count($candidates) < 1)
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">該当する候補がいません。申し訳ないのですが、条件を変えて再度検索をお願い致します。</li>
    </ul>
    @endif

    <h3>{{ $variety->name }}　候補一覧</h3>
    
    <!--飼育上の注意-->
    <!--<p class="mb-1">{{ $variety->name }}の飼育上の注意</p>-->
    <!--<div class="border border-primary mb-2">-->
    <!--    <div class="col-2 d-inline-block">-->
    <!--        <p class="mb-0">特徴</p>-->
    <!--        <p class="mb-0">{{ $variety->feature }}</p>-->
    <!--    </div>-->
    <!--    <div class="col-2 d-inline-block">-->
    <!--        <p class="mb-0">平均寿命</p>-->
    <!--        <p class="mb-0">{{ $variety->lifespan }}</p>-->
    <!--    </div>-->
    <!--    <div class="col-2 d-inline-block">-->
    <!--        <p class="mb-0">必要な道具</p>-->
    <!--        <p class="mb-0">{{ $variety->breedingtool }}</p>-->
    <!--    </div>-->
    <!--    <div class="col-2 d-inline-block">-->
    <!--        <p class="mb-0">費用</p>-->
    <!--        <p class="mb-0">{{ $variety->cost }}</p>-->
    <!--    </div>-->
    <!--</div>-->

    <!--条件絞り込み&表示順-->
    {!! Form::open(['route' => ['variety.show',$variety->id], 'method' => 'GET']) !!}
    <p class="mb-1">条件指定</p>
        <div class="form-group border border-warning mb-2 pt-1"  style="height: 90px;">

            {!! Form::label('place_address1', '場所①:') !!}
            {!! Form::text('place_address1', Request::get('place_address1'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control col-2 d-inline-block mr-3']) !!}
            
            {!! Form::label('place_address2', '場所②:') !!}
            {!! Form::text('place_address2', Request::get('place_address2'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control col-2 d-inline-block mr-3']) !!}
               
            {!! Form::label('place_address3', '場所③:') !!}
            {!! Form::text('place_address3', Request::get('place_address3'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control col-2 d-inline-block mr-3']) !!}
            
            {!! Form::label('gender', '性別:') !!}
            <!--{!! Form::select('gender',['オス'=>'オス','メス'=>'メス'], null, ['placeholder' => '性別を選択','class' => 'form-control']) !!}-->
            <span>オス </span>{!! Form::radio('gender','オス',Request::get('gender')) !!}
            <span>メス </span>{!! Form::radio('gender','メス',Request::get('gender')) !!}
            <br>        
            {!! Form::label('age', '年齢:',['class' => 'ml-3']) !!}
            {!! Form::select('age',['2'=>'2歳以下','4'=>'4歳以下','6'=>'6歳以下','8'=>'8歳以下'],Request::get('age'), ['placeholder' => '上限なし','class' => 'form-control col-2 d-inline-block mr-3']) !!}
            
            {!! Form::label('price', '値段:') !!}
            {!! Form::select('price',['50000'=>'50000円以下','70000'=>'70000円以下','90000'=>'90000円以下','110000'=>'110000円以下'],Request::get('price'), ['placeholder' => '上限なし','class' => 'form-control col-2 d-inline-block mr-3']) !!}
                    
            {!! Form::label('coupon', 'クーポン有のみ表示:') !!}
            {!! Form::checkbox('coupon','有',Request::get('coupon')) !!}
            
            @if(Auth::guard('admin')->check())
                {!! Form::label('birthday', '誕生日:') !!}
                {!! Form::text('birthday',Request::get('birthday'), ['placeholder' => '誕生日','class' => 'form-control col-2 d-inline-block mr-3']) !!}
                
                {!! Form::label('id', '候補ID:') !!}
                {!! Form::text('id',Request::get('id'), ['placeholder' => '候補ID','class' => 'form-control col-1 d-inline-block']) !!}
            @endif
                    
        </div>
    <p class="mb-1">表示順指定</p>
        <div class="form-group border border-warning mb-2 pt-1"  style="height: 50px;">
            {!! Form::label('sort','表示順：') !!}
            <span>記載日：新</span>{!! Form::radio('sort','記載日降順') !!}
            <span class="ml-4">値段：高</span>{!! Form::radio('sort','値段降順',old('sort')) !!}
            <span class="ml-4">値段：低</span>{!! Form::radio('sort','値段昇順',old('sort')) !!}
            <span class="ml-4">年齢：高</span>{!! Form::radio('sort','年齢降順',old('sort')) !!}
            <span class="ml-4">年齢：低</span>{!! Form::radio('sort','年齢昇順',old('sort')) !!}
        </div>
        {!! Form::submit('検索', ['class' => 'btn btn-warning col-9']) !!}
        <a href="{{ route('variety.show', $variety->id,) }}" class='col-2 btn btn-danger'>条件リセット</a>
    {!! Form::close() !!}
      
    <!--候補数-->
    <p class="mt-3">候補数：{{ $candidates->total() }}件中{{ $candidates->count() }}件表示</p>  
    {{ $candidates->appends(request()->input())->links() }}
    
    <!--並び替え-->
    <!--<div class="row mb-3">-->
    <!--    <div class="col-3">-->
    <!--    <span>記載日</span>-->
    <!--    {!! Form::open(['route' => ['candidate.created_at_asc',$variety->id], 'method' => 'GET']) !!}-->
    <!--        @foreach($candidates as $candidate)-->
    <!--            {!! Form::hidden('candidate_ids[]', $candidate->id) !!}-->
    <!--        @endforeach-->
    <!--        {!! Form::hidden('variety_id', $variety->id) !!}-->
    <!--        {!! Form::submit('古', ['class' => 'btn btn-warning col-2']) !!}-->
    <!--    {!! Form::close() !!}-->
    <!--</div>-->
    
    <!--候補一覧-->
    @if(count($candidates) > 0)
        @foreach($candidates as $candidate)
            <div style='position:relative; z-index:1' class="mb-1 border border-primary ml-3 pl-0">
                <a href="{{ route('candidate.show', $candidate->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                @if(Auth::guard('admin')->check())
                    <a href="{{ route('candidate.edit', $candidate->id) }}" style='position: relative; z-index:3' class="btn btn-secondary">編集</a>
                    {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-secondary','style'=>'position:relative; z-index:3']) !!}
                    {!! Form::close() !!}
                @elseif(Auth::guard('web')->check())
                    @if (Auth::user()->is_favorite($candidate->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete']) !!}
                            {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['favorites.favorite', $candidate->id]]) !!}
                            {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}               
                    @endif
                @endif
                
                @if($candidate->coupon != NULL)
                    <a href="{{ route('candidate.coupon', $candidate->id) }}" style='position: relative; z-index:3' class="btn btn-warning">クーポン使用</a>
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
                        @if(Auth::guard('admin')->check())
                            <p class="mb-0 text-danger">id　　  ：{{ $candidate->id }}</p>
                        @endif
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
