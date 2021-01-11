@extends('layouts.app')

@section('content')
    <div class="row no-gutters justify-content-center">
        <h5 class=" col-10 pt-2 title text-center"><i class="fas fa-paw icon"></i>管理者ログイン<i class="fas fa-paw icon"></i></h5>
        
        <div class="col-lg-7 col-10 pt-0 pr-2 pl-2 mb-3">
            {!! Form::open(['route' => 'admin.login']) !!}
                <div class="form-group mb-1">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
    
                <div class="form-group mb-3">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
    
                {!! Form::submit('ログイン', ['class' => 'btn add-btn']) !!}
            {!! Form::close() !!}
        </div>
        
        <p class="col-10 text-center ">{!! link_to_route('admin.showregister', '管理者登録', [], ['style' => 'text-decoration:none;']) !!}</p>
    </div>
@endsection