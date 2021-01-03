@extends('layouts.app')

@section('content')
    <!--アラート-->
    @if(count($candidates) < 1)
    <ul class="alert alert-danger" role="alert">
        <li class="ml-4">該当する候補がいません。申し訳ないのですが、条件を変えて再度検索をお願い致します。</li>
    </ul>
    @endif

    <div class="container">
        <!--タイトル-->
        @foreach($categories as $category)
            @if($category->id == $variety->category_id)
                <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i><a href="{{ route('category.show', $category->id,) }}" style="color:black; text-decoration:none;">{{ $category->name }}</a> > {{ $variety->name }}</h5>
            @endif
        @endforeach
        
        <!--条件絞り込み&並び替え-->
        <div class="pt-0 pl-2 pr-2 pb-2">
            {!! Form::open(['route' => ['variety.show',$variety->id], 'method' => 'GET', 'id'=>'searchSort' , 'class' => 'row no-gutters align-items-end']) !!}
                <!--条件絞り込み-->
                <div class="col-12 pl-0 pr-0">
                    <p class="p-0 m-0" id="subtitle"><i class="fas fa-search icon"></i>条件絞り込み <i class="fas fa-sort-down" style="vertical-align:0" id="updown"></i></p>
                    <div class="form-group mb-2 pt-2 pl-md-3 search-show rounded hide" id="search">
                        {!! Form::label('place_address1', '場所①:', ['class' => 'ml-1']) !!}
                        {!! Form::text('place_address1', Request::get('place_address1'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control d-inline-block search-form mb-1']) !!}
                        <br>
                        {!! Form::label('place_address2', '場所②:',['class' => 'ml-1']) !!}
                        {!! Form::text('place_address2', Request::get('place_address2'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control d-inline-block search-form mb-1']) !!}
                        <br>           
                        {!! Form::label('place_address3', '場所③:', ['class' => 'ml-1']) !!}
                        {!! Form::text('place_address3', Request::get('place_address3'), ['placeholder' => '都道府県 or 市区町村','class' => 'form-control d-inline-block search-form mb-1']) !!}
                        <br>
                        {!! Form::label('gender', '性別:',['class' => 'ml-1']) !!}
                        <span>オス </span>{!! Form::radio('gender','オス',Request::get('gender')) !!}
                        <span>メス </span>{!! Form::radio('gender','メス',Request::get('gender')) !!}
                        <br>
                        {!! Form::label('price', '値段:',['class' => 'ml-1']) !!}
                        {!! Form::select('price',['50000'=>'50000円以下','70000'=>'70000円以下','90000'=>'90000円以下','110000'=>'110000円以下'],Request::get('price'), ['placeholder' => '上限なし','class' => 'form-control d-inline-block search-form mb-1']) !!}
                        <br>        
                        {!! Form::label('coupon', 'クーポン有のみ表示:',['class' => 'ml-1']) !!}
                        {!! Form::checkbox('coupon','有',Request::get('coupon'),['class' => 'mr-3']) !!}
                                
                        @if(Auth::guard('admin')->check())
                            {!! Form::label('birthday', '誕生日:') !!}
                            {!! Form::text('birthday',Request::get('birthday'), ['placeholder' => '誕生日','class' => 'form-control col-2 d-inline-block mr-3']) !!}
                                
                            {!! Form::label('id', '候補ID:') !!}
                            {!! Form::text('id',Request::get('id'), ['placeholder' => '候補ID','class' => 'form-control col-1 d-inline-block']) !!}
                        @endif
                    </div>
                </div>
            
                <!--並び替え-->
                <div class="col-md-6 col-12 pl-0 pr-0">
                    <p class="p-0 m-0"><i class="fas fa-sort-amount-down icon"></i>並び替え</p>
                    <div class="form-group mb-1 p-0 rounded-bottom text-center" id="sort" style="font-size:0;">
                        <div class="w-25 m-0 p-0 d-inline-block sort-select-l1 rounded-left" id="created">
                            {!! Form::label('sortCreated', '新着順',['class' => 'w-100 m-0']) !!}{!! Form::radio('sort','記載日降順',old('sort'),['id' => 'sortCreated','class' => 'mr-2 hide']) !!}
                        </div>
                        <div class="w-25 m-0 p-0 d-inline-block sort-select-l2" id="pricesort">
                            {!! Form::label('sortPrice', '安い順',['class' => 'w-100 m-0']) !!}{!! Form::radio('sort','値段昇順',old('sort'),['id' => 'sortPrice','class' => 'mr-2 hide']) !!}
                        </div>
                        <div class="w-25 m-0 p-0 d-inline-block sort-select-l2" id="age">
                            {!! Form::label('sortAge', '若い順',['class' => 'w-100 m-0']) !!}{!! Form::radio('sort','誕生日昇順',old('sort'),['id' => 'sortAge','class' => 'mr-2 hide']) !!}
                        </div>
                        <div class="w-25 m-0 p-0 d-inline-block sort-select-l2 rounded-right" id="visited">
                            {!! Form::label('sortVisited', '人気順',['class' => 'w-100 m-0']) !!}{!! Form::radio('sort','閲覧数降順',old('sort'),['id' => 'sortVisited','class' => 'mr-2 hide']) !!}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5 col-12 mb-1 mx-auto pl-0 pr-0 d-flex justify-content-between">
                    {!! Form::submit('検索/並べ替え', ['class' => 'btn search-btn search-sort']) !!}
                    <a href="{{ route('variety.show', $variety->id,) }}" class='btn search-btn reset'>リセット</a>
                </div>
            {!! Form::close() !!}
        </div>
        
        <!--候補一覧-->
        <div class="row pt-0 pl-2 pr-2 mx-auto row no-gutters">
            <!--候補数-->
            <div class="w-100">
                <p class="m-0 d-inline-block">{{ $candidates->total() }}件中{{ $candidates->count() }}件表示</p>  
                {{ $candidates->appends(request()->input())->links("vendor.pagination.default") }}
            </div>
            
            <!--候補一覧-->
            @if(count($candidates) > 0)
                @foreach($candidates as $candidate)
                    @php
                        $price = $candidate->price;
                        $priceShow = number_format($price);
                    @endphp
                
                    <div class="col-lg-10 col-12 content bg-white border border-dark rounded row p-0 mx-auto mt-1 background-2" style="width:90%;">
                        <div class="col-5 p-2 d-flex align-items-center">
                            @foreach($candidatephotos as $candidatephoto)
                                @if ($candidatephoto->candidate_id == $candidate->id)
                                    <img src="{{ $candidatephoto->image_path }}" class="img-fluid d-inline-block mx-auto candidate-img">
                                    @break
                                @endif
                            @endforeach
                        </div>
    
                        <div class="col-7 m-0 p-md-3 p-1 small">
                            @if(Auth::guard('admin')->check())
                                <p class="mb-0">id　　  ：{{ $candidate->id }}</p>
                            @endif
                            <p class="mb-0">値段：{{ $priceShow }}円(税込)</p>
                            <p class="mb-0">誕生日：{{ $candidate->birthday }}</p>
                            <p class="mb-0">性別：{{ $candidate->gender }}</p>
                            <p class="mb-0">性格：{{ $candidate->personality }}</p>
                            <p class="mb-0">場所：{{ $candidate->place_name }}</p>
                        </div>
                    
                        @if(Auth::guard('admin')->check())
                            <div class="admin">
                                <a href="{{ route('candidate.edit', $candidate->id) }}" class="d-inline-block h-100"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                                {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                                    {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                                {!! Form::close() !!}
                            </div>
                        @elseif(Auth::guard('web')->check())
                            @if(Auth::user()->is_favorite($candidate->id))
                                <div class="favorite">
                                    {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete']) !!}
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn p-0 removefavorite' , 'style' => 'color:crimson;'] ) !!}
                                    {!! Form::close() !!}
                                </div>
                            @else
                                <div class="favorite">
                                    {!! Form::open(['route' => ['favorites.favorite', $candidate->id]]) !!}
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn p-0 addfavorite'] ) !!}
                                    {!! Form::close() !!}  
                                </div>
                            @endif
                        @endif
                        
                        <a href="{{ route('candidate.show', $candidate->id,) }}" class="link"></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
