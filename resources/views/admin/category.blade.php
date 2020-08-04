@extends('layouts.app')

@section('content')
    <h1>カテゴリー追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($category, ['route' => 'category.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'カテゴリー名:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            
                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection