@extends('layouts.app')

@section('content')
    <h1>都道府県追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($place, ['route' => 'place.store']) !!}

                <div class="form-group">
                    {!! Form::label('place', '都道府県名:') !!}
                    {!! Form::text('place', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection