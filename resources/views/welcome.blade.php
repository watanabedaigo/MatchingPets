@extends('layouts.app')

@section('content')
    @if(Auth::guard('admin')->check())
        <p>管理者ログイン済み</p>
        <p>{!! link_to_route('index','データ追加',[],['class' => 'btn btn-success']) !!}</p>
    @elseif(Auth::guard('web')->check())
        <p>ユーザーログイン済み</p>
    @else
        <p>ログインしていない場合のトップページ</p>

    @endif    
@endsection