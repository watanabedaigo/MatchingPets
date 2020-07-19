@extends('layouts.app')

@section('content')
    <h1>品種追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($variety, ['route' => 'variety.store']) !!}

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

                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
                <p>{!! link_to_route('index','データ追加ページへ',[],['class' => 'btn btn-success mt-3']) !!}</p>

            {!! Form::close() !!}
        </div>
    </div>
@endsection