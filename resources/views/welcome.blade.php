@extends('layouts.app')

@section('content')
    @if(Auth::check())
        {{ Auth::user()->name }}
        <p>ログイン時</p>
    @else
        <p>ログインしていない</p>
    @endif
@endsection