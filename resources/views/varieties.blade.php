@extends('layouts.app')

@section('content')
    <div>
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>{{ $category->name }}</h5>
        <div class="category-container row pt-0 pl-2 pr-2">
             @if(count($varieties) > 0)
                @foreach($varieties as $variety)
                    <div class="col-sm-2 col-3 p-0 mb-1 ">
                        <div class="category bg-white border-dark border rounded pt-1 mr-1 background-2" style="height:24vmin">
                            @if(Auth::guard('admin')->check())
                                <p class="m-0 text-center w-100 font-weight-bold" style="font-size:3vw;">ID{{ $variety->id }}.{{ $variety->name }}({{ count($variety->candidates()->get()) }}匹掲載) {{ $variety->view_count }}回訪問</p>
                                <a href="{{ route('variety.edit', $variety->id) }}" style='position: relative; z-index:3' class="btn btn-secondary">編集</a>
                                {!! Form::model($variety, ['route' => ['variety.destroy', $variety->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-secondary','style'=>'position:relative; z-index:3']) !!}
                                {!! Form::close() !!}
                            @else
                                <p class="m-0 text-center w-100 font-weight-bold" style="font-size:3vw;">{{ $variety->name }}</p>
                            @endif
                            
                            @foreach($varietyphotos as $varietyphoto)
                                @if ($varietyphoto->variety_id == $variety->id)
                                    <img src="{{ $varietyphoto->image_path }}" class="d-block img-fluid mx-auto" style="max-width:75%;">
                                @endif
                            @endforeach
                            
                            <a href="{{ route('variety.show', $variety->id) }}" class="link"></a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection