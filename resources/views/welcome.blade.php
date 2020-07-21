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
    
    <h1>カテゴリー一覧</h1>
    @if(count($categories) > 0)
        @foreach($categories as $category)
            <p>{!! link_to_route('category.show',$category->name, ['id' => $category->id], ['class' => 'btn btn-primary']) !!}</p>
        @endforeach
    @endif
@endsection