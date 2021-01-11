@extends('layouts.app')

@section('content')
    <div class="row no-gutters justify-content-center">
        <h5 class="col-10 pt-2 title text-center"><i class="fas fa-paw icon"></i>品種写真追加</h5>
        
        <div class="col-lg-7 col-10 category-container pt-0 pr-2 pl-2 mb-2">
            {!! Form::model($varietyphoto, ['route' => 'varietyphoto.store', 'files' => true]) !!}
                <div class="form-group mb-1">
                    {!! Form::label('variety_id', '品種ID',['class' => 'm-0']) !!}
                    @if(isset($variety))
                        {!! Form::text('variety_id', $variety->id, ['class' => 'form-control']) !!}
                    @else
                        {!! Form::text('variety_id', null, ['class' => 'form-control']) !!}
                    @endif
                </div>
                    
                <div class="mb-1">
                    {!! Form::file('image', $attributes = []) !!}<!--<input type="file" name="image">-->
                    {{ csrf_field() }}
                    <!--<input type="submit" value="アップロード">-->
                </div>
                {!! Form::submit('追加', ['class' => 'btn add-btn']) !!}
            {!! Form::close() !!}
        </div>
        
        <p class="col-10 text-center">{!! link_to_route('index','戻る', [], ['class' => 'btn link-btn' , 'style' => 'text-decoration:none;']) !!}</p>
    </div>
@endsection