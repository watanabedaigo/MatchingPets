@extends('layouts.app')

@section('content')
    <div class="row no-gutters justify-content-center">
        <h5 class="col-10 pt-2 title text-center"><i class="fas fa-paw icon"></i>無料会員登録<i class="fas fa-paw icon"></i></h5>
        
        <div class="col-lg-7 col-10 category-container pt-0 pr-2 pl-2 mb-3">
            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group mb-1">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('gender', '性別') !!}
                    {!! Form::select('gender',['男性'=>'男性','女性'=>'女性'],null,['class'=>'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('age', '年齢') !!}
                    {!! Form::text('age', old('age'), ['class' => 'form-control']) !!}
                </div>
    
                <div class="form-group mb-1">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-3">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
    
                {!! Form::submit('登録', ['class' => 'btn add-btn']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection