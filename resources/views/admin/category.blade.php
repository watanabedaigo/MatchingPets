@extends('layouts.app')

@section('content')
    <div class="row no-gutters justify-content-center">
        <h5 class="col-10 pt-2 title text-center"><i class="fas fa-paw icon"></i>カテゴリー追加</h5>
        
        <div class="col-lg-7 col-10 category-container pt-0 pr-2 pl-2 mb-2">
            {!! Form::model($category, ['route' => 'category.store']) !!}
                <div class="form-group mb-1">
                    {!! Form::label('name', 'カテゴリー名',['class' => 'm-0']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('追加', ['class' => 'btn add-btn']) !!}
            {!! Form::close() !!}
        </div>
        
        <p class="col-10 text-center">{!! link_to_route('index','戻る', [], ['class' => 'btn link-btn' , 'style' => 'text-decoration:none;']) !!}</p>
    </div>
@endsection