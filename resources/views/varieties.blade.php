@extends('layouts.app')

@section('content')
    <h3>{{ $category->name }}　品種一覧</h3>
    <div class="row">
         @if(count($varieties) > 0)
            @foreach($varieties as $variety)
                <div class="mb-1 col-4 border border-primary ml-3 pl-0">
                    @if(Auth::guard('admin')->check())
                        <p class = "mt-0 mb-0">{!! link_to_route('variety.show','ID'.$variety->id.'.'.$variety->name.'('.count($variety->candidates()->get()).')', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}</p>
                        <p class="mb-0">{!! link_to_route('variety.edit', '編集', ['id' => $variety->id], ['class' => 'btn btn-secondary']) !!}</p>
                        {!! Form::model($variety, ['route' => ['variety.destroy', $variety->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary']) !!}
                        {!! Form::close() !!}
                    @else
                        <p class = "mt-0 mb-0">{!! link_to_route('variety.show',$variety->name.'('.count($variety->candidates()->get()).')', ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}</p>
                    @endif
                    
                    @foreach($varietyphotos as $varietyphoto)
                        @if ($varietyphoto->variety_id == $variety->id)
                        <img src="{{ $varietyphoto->image_path }}" class="d-block mx-auto">
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
@endsection