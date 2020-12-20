@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>クーポンを使用</h5>
        <div class="row pt-0 pl-2 pr-2 mx-auto">
            <div class="mb-2">
                <p class="m-0">この度は {{ $candidate->place_name }} のペットを購入していただき、ありがとうございます。新しい家族と、かけがえのない時間をお過ごし下さい。</p>
            </div>
            <div class="w-100" style="position:relative;">
                <div class=" w-25 mx-auto border border-dark rounded small text-center pl-1 pr-1" style="position:absolute; top:0; left:0; right:0; background-color:khaki; z-index:1;">
                    <p class="m-0">クーポン詳細</p>
                </div>
                <div class="mx-auto border border-dark rounded p-2" style="width:90%; position:absolute; top:10px; left:0; right:0; background-color:snow;">
                    <p class="m-0">a</p>
                </div>
            </div>
        </div>
    </div>
@endsection