@extends('layouts.app')

@section('content')
    @if(Auth::guard('admin')->check())
        <p>{!! link_to_route('index','データ追加',[],['class' => 'btn btn-success']) !!}</p>
    @endif
    
    <h3>カテゴリー一覧</h3>
    <div class="row">
        @if(count($categories) > 0)
            @foreach($categories as $category)
                <div class="mb-1 col-4 border border-primary">
                    <p class = "mt-1 mb-0">{!! link_to_route('category.show',$category->name, ['id' => $category->id], ['class' => 'btn btn-primary']) !!}</p>
                
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