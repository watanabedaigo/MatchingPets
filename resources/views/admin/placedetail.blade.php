@extends('layouts.app')

@section('content')
    <h1>市区町村追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($placedetail, ['route' => 'placedetail.store']) !!}

                <div class="form-group">
                    {!! Form::label('place_id', '都道府県ID:') !!}
                    {!! Form::text('place_id', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('placede_details', '市区町村名:') !!}
                    {!! Form::text('place_details', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
                <p>{!! link_to_route('index','データ追加ページへ',[],['class' => 'btn btn-success mt-3']) !!}</p>

            {!! Form::close() !!}
        </div>
    </div>
@endsection