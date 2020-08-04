@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($category, ['route' => ['category.update',$category->id],'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'カテゴリー名:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection