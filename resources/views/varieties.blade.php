@extends('layouts.app')

@section('content')
    <h3>{{ $category->name }}　品種一覧</h3>
    <div class="row">
         @if(count($varieties) > 0)
            @foreach($varieties as $variety)
                @if(Auth::guard('admin')->check())
                    <div style='position:relative; z-index:1' class="mb-1 col-4 border border-primary ml-3 pl-0">
                        <p>ID{{ $variety->id }}.{{ $variety->name }}({{ count($variety->candidates()->get()) }})</p>
                        <p>閲覧数：{{ $variety->view_count }}</p>
                        @foreach($varietyphotos as $varietyphoto)
                            @if ($varietyphoto->variety_id == $variety->id)
                                <img src="{{ $varietyphoto->image_path }}" class="d-block mx-auto">
                            @endif
                        @endforeach
                        <a href="{{ route('variety.show', $variety->id,) }}" style='position:absolute; top:0; left:0; height:100%; width:100%; z-index:2'></a>
                        <a href="{{ route('variety.edit', $variety->id) }}" style='position: relative; z-index:3' class="btn btn-secondary">編集</a>
                        {!! Form::model($variety, ['route' => ['variety.destroy', $variety->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary','style'=>'position:relative; z-index:3']) !!}
                        {!! Form::close() !!}
                    </div>
                @else
                    <div style='position:relative;' class="mb-1 col-4 border border-primary ml-3 pl-0">
                        <p>{{ $variety->name }}({{ count($variety->candidates()->get()) }})</p>
                        @foreach($varietyphotos as $varietyphoto)
                            @if ($varietyphoto->variety_id == $variety->id)
                                <img src="{{ $varietyphoto->image_path }}" class="d-block mx-auto">
                            @endif
                        @endforeach
                        <a href="{{ route('variety.show', $variety->id) }}" style='position:absolute; top:0; left:0; height:100%; width:100%;'></a>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection