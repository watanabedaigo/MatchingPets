@extends('layouts.app')

@section('content')
    <h1>候補詳細</h1>
    <div class="border border-primary">
        <p>{{ $candidate->price }}</p>
        <p>{{ $candidate->age }}</p>
        <p>{{ $candidate->gender }}</p>
        <p>{{ $candidate->personality }}</p>
        <p>{{ $candidate->personality_details }}</p>
        <p>{{ $candidate->inspection }}</p>
        <p>{{ $candidate->place_name }}</p>
        <p>{{ $candidate->place_address }}</p>
        <p>{{ $candidate->place_phonenumber }}</p>
        <p>{{ $candidate->place_bussinesshours }}</p>
</div>
@endsection