@extends('layouts.app')

@section('content')
    <h1>品種写真追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($varietyphoto, ['route' => 'varietyphoto.store', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('variety_id', '品種ID:') !!}
                    {!! Form::text('variety_id', null, ['class' => 'form-control']) !!}
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