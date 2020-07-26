@extends('layouts.app')

@section('content')
    <h3>品種　フリーワード検索</h3>
    <div class="row"> 
        <div class="form-group col-6">
            {!! Form::open(['route' => 'variety.search', 'method' => 'GET']) !!}
                {!! Form::label('name', '品種名') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! Form::submit('検索', ['class' => 'btn btn-secondary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <h3>カテゴリー一覧</h3>
    <div class="row">
        @if(count($categories) > 0)
            @foreach($categories as $category)
                <div class="mb-1 col-4 border border-primary ml-3 pl-0">
                    <p class = "mt-0 mb-0">{!! link_to_route('category.show',$category->name, ['id' => $category->id], ['class' => 'btn btn-primary']) !!}</p>
                
                    @foreach($categoryphotos as $categoryphoto)
                        @if ($categoryphoto->category_id == $category->id)
                        <img src="{{ $categoryphoto->image_path }}" class="d-block mx-auto">
                        @endif
                    @endforeach
                
                    @if(Auth::guard('admin')->check())
                        <p class="mb-0">{!! link_to_route('category.edit', '編集', ['id' => $category->id], ['class' => 'btn btn-secondary']) !!}</p>
                        {!! Form::model($category, ['route' => ['category.destroy', $category->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection