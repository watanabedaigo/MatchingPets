@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>お気に入り一覧 ({{ $favorites->count() }}件)</h5>
        <div class="category-container row pt-0 pl-2 pr-2">
            <!--候補一覧-->
            @if(count($favorites) > 0)
                @foreach($favorites as $favorite)
                    @php
                        $price = $favorite->price;
                        $priceShow = number_format($price);
                    @endphp
                
                    <div class="popularityvariety bg-white border border-dark rounded row p-0 mx-auto mt-1 background-2" style="width:90%;">
                        <div class="col-5 pt-1 pb-1 pl-2 pr-2 text-center d-flex align-items-center">
                            @foreach($candidatephotos as $candidatephoto)
                                @if ($candidatephoto->candidate_id == $favorite->id)
                                    <img src="{{ $candidatephoto->image_path }}" class="img-fluid">
                                    @break
                                @endif
                            @endforeach
                        </div>
    
                        <div class="col-7 m-0 p-0 small">
                            <p class="mb-0">値段：{{ $priceShow }}円(税込)</p>
                            <p class="mb-0">誕生日：{{ $favorite->birthday }}</p>
                            <p class="mb-0">性別：{{ $favorite->gender }}</p>
                            <p class="mb-0">性格：{{ $favorite->personality }}</p>
                            <p class="mb-0">場所：{{ $favorite->place_name }}</p>
                        </div>
                    
                        @if(Auth::guard('web')->check())
                            @if(Auth::user()->is_favorite($favorite->id))
                                <div class="favorite">
                                    {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn removefavorite' , 'style' => 'color:crimson;'] ) !!}
                                    {!! Form::close() !!}
                                </div>
                            @else
                                <div class="favorite">
                                    {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn addfavorite'] ) !!}
                                    {!! Form::close() !!}  
                                </div>
                            @endif
                        @endif
                        
                        <a href="{{ route('candidate.show', $favorite->id,) }}" class="link"></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection