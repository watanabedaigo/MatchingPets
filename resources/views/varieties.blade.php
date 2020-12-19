@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>{{ $category->name }}</h5>
        <div class="category-container row pt-0 pl-2 pr-2">
             @if(count($varieties) > 0)
                @foreach($varieties as $variety)
                    <div class="col-sm-2 col-3 p-0 mb-1 ">
                        <div class="category bg-white border-dark border rounded pt-1 mr-1 background-2" id="category">
                            <p class="m-0 text-center w-100 font-weight-bold">
                                @if(Auth::guard('admin')->check())
                                    {{ $variety->id }}.
                                @endif
                                {{ $variety->name }}
                            </p>

                            @foreach($varietyphotos as $varietyphoto)
                                @if ($varietyphoto->variety_id == $variety->id)
                                    <img src="{{ $varietyphoto->image_path }}" class="d-block img-fluid mx-auto" style="max-width:75%;">
                                @endif
                            @endforeach
                            
                            <a href="{{ route('variety.show', $variety->id) }}" class="link"></a>
                        </div>
                        
                        @if(Auth::guard('admin')->check())
                            <div class="d-flex justify-content-center" style="height:1rem;">
                                <a href="{{ route('variety.edit', $variety->id) }}" class="d-inline-block h-100"><i class="fas fa-edit" style="vertical-align:top;"></i></a>
                                {!! Form::model($variety, ['route' => ['variety.destroy', $variety->id], 'method' => 'delete','class' => 'd-inline-block']) !!}
                                    {!! Form::button('<i class="fa fa-trash" style="vertical-align:top;"></i>', ['type' => 'submit', 'class' => 'btn p-0'] ) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection