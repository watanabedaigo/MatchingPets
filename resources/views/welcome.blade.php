@extends('layouts.app')

@section('content')
    @if(Auth::guard('admin')->check())
        <p>{!! link_to_route('index','データ追加',[],['class' => 'btn btn-success']) !!}</p>
    @endif
    
    <h1>カテゴリー一覧</h1>
    @if(count($categories) > 0)
        @foreach($categories as $category)
            <div class="mb-1">
                {!! link_to_route('category.show',$category->name, ['id' => $category->id], ['class' => 'btn btn-primary']) !!}
                @if(Auth::guard('admin')->check())
                    <p class="mb-0">{!! link_to_route('category.edit', '編集', ['id' => $category->id], ['class' => 'btn btn-secondary']) !!}</p>
                    {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                    {!! Form::close() !!}
                @endif
                <br>
            </div>
        @endforeach
    @endif
@endsection