@extends('layouts.app')

@section('content')
    @if(Auth::guard('admin')->check())
        <p>管理者ログイン済み</p>
        <p>データ追加画面へのリンク</p>
    @elseif(Auth::guard('web')->check())
        <p>ユーザーログイン済み</p>
    @else
        <p>ログインしていない場合のトップページ</p>

    @endif    
@endsection