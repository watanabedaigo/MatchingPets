@extends('layouts.app')

@section('content')
    <div class="row no-gutters justify-content-center">
        <h5 class="col-10 pt-2 title text-center"><i class="fas fa-paw icon"></i>{{ $variety->name }} 編集</h5>
        
        <div class="col-lg-7 col-10 category-container pt-0 pr-2 pl-2 mb-2">
            {!! Form::model($variety, ['route' => ['variety.update',$variety->id],'method' => 'put']) !!}
                <div class="form-group mb-1">
                    {!! Form::label('category_id', 'カテゴリーID',['class' => 'm-0']) !!}
                    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('name', '品種名',['class' => 'm-0']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('feature', '特徴',['class' => 'm-0']) !!}
                    {!! Form::textarea('feature', null, ['class' => 'form-control', 'rows' => '5' , 'cols' => '1000']) !!}
                </div>
                
                <!--<div class="form-group mb-1">-->
                <!--    {!! Form::label('lifespan', '寿命',['class' => 'm-0']) !!}-->
                <!--    {!! Form::text('lifespan', null, ['class' => 'form-control']) !!}-->
                <!--</div>-->
                <!--<div class="form-group mb-1">-->
                <!--    {!! Form::label('breedingtool', '必要な道具',['class' => 'm-0']) !!}-->
                <!--    {!! Form::text('breedingtool', null, ['class' => 'form-control']) !!}-->
                <!--</div>-->
                <!--<div class="form-group mb-3">-->
                <!--    {!! Form::label('cost', '平均的な費用',['class' => 'm-0']) !!}-->
                <!--    {!! Form::text('cost', null, ['class' => 'form-control']) !!}-->
                <!--</div>-->
                
                {!! Form::submit('更新', ['class' => 'btn add-btn']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection