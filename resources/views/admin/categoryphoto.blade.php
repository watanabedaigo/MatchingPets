@extends('layouts.app')

@section('content')
    <h1>カテゴリー写真追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($categoryphoto, ['route' => 'categoryphoto.store', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('category_id', 'カテゴリーID:') !!}
                    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="mb-3">
                    {!! Form::file('image', $attributes = []) !!}<!--<input type="file" name="image">-->
                    {{ csrf_field() }}
                    <!--<input type="submit" value="アップロード">-->
                </div>
              
                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection