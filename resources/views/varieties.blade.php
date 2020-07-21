@extends('layouts.app')

@section('content')
    <h1>品種一覧</h1>
    {{ $category->name }}
     @if(count($varieties) > 0)
        @foreach($varieties as $variety)
            <p>{!! link_to_route('variety.show',$variety->name, ['id' => $variety->id], ['class' => 'btn btn-primary']) !!}</p>
        @endforeach
    @endif
@endsection