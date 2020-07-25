@extends('layouts.app')

@section('content')
    <h1>品種一覧</h1>
    {{ $category->name }}
     @if(count($varieties) > 0)
        @foreach($varieties as $variety)
            <div class="mb-1">
                {!! link_to_route('variety.show',$variety->name, ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}
                @if(Auth::guard('admin')->check())
                    <p class="mb-0">{!! link_to_route('variety.edit', '編集', ['id' => $variety->id], ['class' => 'btn btn-secondary']) !!}</p>
                    {!! Form::model($variety, ['route' => ['variety.destroy', $variety->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                    {!! Form::close() !!}
                @endif
                <br>
            </div>
        @endforeach
    @endif
@endsection