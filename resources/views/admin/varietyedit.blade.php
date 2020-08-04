@extends('layouts.app')

@section('content')
    <h1>{{ $variety->name }}の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($variety, ['route' => ['variety.update',$variety->id],'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', '品種名:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'カテゴリーID:') !!}
                    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('feature', '飼育上の注意点:') !!}
                    {!! Form::text('feature', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lifespan', '寿命:') !!}
                    {!! Form::text('lifespan', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('breedingtool', '必要な道具:') !!}
                    {!! Form::text('breedingtool', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('cost', '平均的な費用:') !!}
                    {!! Form::text('cost', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection