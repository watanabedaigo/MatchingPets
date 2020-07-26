@extends('layouts.app')

@section('content')
    <h3>{{ $variety->name }}　飼育上の注意</h3>
    
    <div class="col-6 border border-primary">
        <p class="mb-0">特徴</p>
        <p>{{ $variety->feature }}</p>
        <p class="mb-0">平均寿命</p>
        <p>{{ $variety->lifespan }}</p>
        <p class="mb-0">必要な道具</p>
        <p>{{ $variety->breedingtool }}</p>
        <p class="mb-0">平均的な費用</p>
        <p>{{ $variety->cost }}</p>
    </div>
@endsection