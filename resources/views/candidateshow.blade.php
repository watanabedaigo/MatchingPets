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
            <div class="col-sm-4 pt-2 pb-2 rounded" style="font-size:0;">
                @foreach($candidatephotos as $candidatephoto)
                    @if ($candidatephoto->candidate_id == $candidate->id)
                        <!--最初のループか否かで場合分け-->
                        @if($loop->first)
                            <a class="popup" href="{{ $candidatephoto->image_path }}"><img src="{{ $candidatephoto->image_path }}" class="d-block mx-auto"></a>
                        @else
                            <div class="d-inline-block" style="width:33%;">
                                <a class="popup" href="{{ $candidatephoto->image_path }}"><img src="{{ $candidatephoto->image_path }}" class="w-100"></a>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            
            <div class="col-sm-8">
                @if(Auth::guard('admin')->check())
                    <p class="mb-0">id　　：{{ $candidate->id }}</p>
                @endif
                
                <table class="table table-sm table-bordered w-100 mt-1" style="font-size:.7rem;">
                    <tr>
                        <th scope="row" class="w-25 text-center" style="background-color:lightgray;">閲覧数</th>
                        <td class="bg-light">{{ $candidate->view_count }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25 text-center" style="background-color:lightgray;">値段</th>
                        <td class="bg-light">{{ $candidate->price }}</td>
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
                        <th scope="row" class="w-25 text-center" style="background-color:lightgray;">検査</th>
                        <td class="bg-light">{{ $candidate->inspection }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25 text-center" style="background-color:lightgray;">飼育場所</th>
                        <td class="bg-light">{{ $candidate->place_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25 text-center" style="background-color:lightgray;">住所</th>
                        <td class="bg-light">{{ $candidate->place_address }}</td>
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
                        <td class="bg-light">{{ $candidate->URL }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25 text-center" style="background-color:lightgray;">クーポン</th>
                        <td class="bg-light">{{ $candidate->coupon }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="mx-auto">
                {!! $candidate->map !!}
            </div>
        
            @if($candidate->coupon != NULL)
                <p>{!! link_to_route('candidate.coupon','クーポンを使う', ['id' => $candidate->id], ['class' => 'btn btn-warning']) !!}</p>
            @endif
            
            @if(Auth::guard('admin')->check())
                <div style="height:1rem; position:absolute; top:0; right:0; z-index:3">
                    <a href="{{ route('candidate.edit', $candidate->id) }}" class="d-inline-block h-100"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                    {!! Form::model($candidate, ['route' => ['candidate.destroy', $candidate->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                        {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                    {!! Form::close() !!}
                </div>
            @elseif(Auth::guard('web')->check())
                @if(Auth::user()->is_favorite($candidate->id))
                    {!! Form::open(['route' => ['favorites.unfavorite', $candidate->id], 'method' => 'delete']) !!}
                        {!! Form::submit('お気に入りから外す', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['favorites.favorite', $candidate->id]]) !!}
                        {!! Form::submit('お気に入りに追加', ['class' => "btn btn-success",'style'=>'position:relative; z-index:3']) !!}
                    {!! Form::close() !!}               
                @endif
            @endif
        </div>
    </div>
@endsection