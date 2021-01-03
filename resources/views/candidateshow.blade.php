@extends('layouts.app')

@section('content')
    <div class="container">
        <!--タイトル-->
        @foreach($varieties as $variety)
            @if($variety->id == $candidate->variety_id)
                @foreach($categories as $category)
                    @if($category->id == $variety->category_id)
                        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i><a href="{{ route('category.show', $category->id,) }}" style="color:black; text-decoration:none;">{{ $category->name }}</a> > <a href="{{ route('variety.show', $variety->id,) }}" style="color:black; text-decoration:none;">{{ $variety->name }}</a></h5>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        <!--候補詳細-->
        @php
            $price = $candidate->price;
            $priceShow = number_format($price);
        @endphp
        <div class="row pt-0 pl-2 pr-2 mx-auto">
            <div class="content bg-white border border-dark rounded row p-md-3 p-0 mx-auto mt-1 background-2 small" style="width:95%;" id="candidate-wrap">
                <div class="col-md-4 pt-2 pb-2 p-md-0 rounded" style="font-size:0;" id="candidate-img-wrap">
                    @foreach($candidatephotos as $candidatephoto)
                        @if ($candidatephoto->candidate_id == $candidate->id)
                            <!--最初のループか否かで場合分け-->
                            @if($loop->first)
                                <a class="popup" href="{{ $candidatephoto->image_path }}"><img src="{{ $candidatephoto->image_path }}" class="d-block w-100"></a>
                            @else
                                <div class="d-inline-block" style="width:33%;">
                                    <a class="popup" href="{{ $candidatephoto->image_path }}"><img src="{{ $candidatephoto->image_path }}" class="w-100"></a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                    
                    <div class="d-flex mt-2 mb-md-2">
                        @if(Auth::guard('web')->check())
                            @if(Auth::user()->is_favorite($candidate->id))
                                <div class="w-50 pr-1">
                                    {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete' , 'class' => 'w-100']) !!}
                                        {!! Form::button('<i class="fas fa-heart"></i><span class="text-dark">お気に入りから外す</span>', ['type' => 'submit', 'class' => 'btn pt-1 pb-1 pl-0 pr-0 w-100 candidate-show-btn' , 'style' => 'color:crimson; background-color:pink;'] ) !!}
                                    {!! Form::close() !!}
                                </div>
                            @else
                                <div class="w-50 pr-1">
                                    {!! Form::open(['route' => ['favorites.favorite', $candidate->id] , 'class' => 'w-100']) !!}
                                        {!! Form::button('<i class="far fa-heart"></i><span class="text-dark">お気に入りに追加</span>', ['type' => 'submit', 'class' => 'btn pt-1 pb-1 pl-0 pr-0 w-100 candidate-show-btn' , 'style' => 'background-color:pink;'] ) !!}
                                    {!! Form::close() !!}  
                                </div>
                            @endif
                        @endif
                        @if($candidate->coupon != NULL)
                            <p class="m-0 w-50 pr-1"><a href="{{ route('candidate.coupon', $candidate->id,) }}" class="d-inline-block w-100 h-100 text-dark btn pb-1 pl-0 pr-0 candidate-show-btn" style="background-color:khaki;"><i class="fas fa-gift"></i>クーポンを使用</a></p> 
                        @endif
                    </div>
                </div>
                
                <div class="col-md-8 mb-1 p-md-0 pl-md-3">
                    @if(Auth::guard('admin')->check())
                        <p class="mb-0">id　　：{{ $candidate->id }}</p>
                    @endif
                    
                    <table class="table table-sm table-bordered w-100 mt-1 mb-1 m-md-0">
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">閲覧</th>
                            <td class="bg-light">{{ $candidate->view_count }}回</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">値段</th>
                            <td class="bg-light">{{ $priceShow }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">誕生日</th>
                            <td class="bg-light">{{ $candidate->birthday }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">性別</th>
                            <td class="bg-light">{{ $candidate->gender }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">性格</th>
                            <td class="bg-light">{{ $candidate->personality_details }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">毛色</th>
                            <td class="bg-light">{{ $candidate->coat_color }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">検査</th>
                            <td class="bg-light">{{ $candidate->inspection }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">飼育場所</th>
                            <td class="bg-light">{{ $candidate->place_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">住所</th>
                            <td class="bg-light" style="word-break:break-all;">{{ $candidate->place_address }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">電話番号</th>
                            <td class="bg-light">{{ $candidate->place_phonenumber }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">営業時間</th>
                            <td class="bg-light">{{ $candidate->bussinesshours }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">URL</th>
                            <td class="bg-light" style="word-break:break-all;"><a href="{{ $candidate->URL }}" target="_blank">{{ $candidate->URL }}</a></td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-center" style="background-color:lightgray;">クーポン</th>
                            <td class="bg-light">{{ $candidate->coupon }}</td>
                        </tr>
                    </table>
                </div>
        
                <div class="col-12 text-center" id="mapshow">
                    {!! $candidate->map !!}
                </div>
                
                @if(Auth::guard('admin')->check())
                    <div class="admin">
                        <a href="{{ route('candidate.edit', $candidate->id) }}" class="d-inline-block h-100"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                        {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                            {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection