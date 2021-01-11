@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="pt-2 ml-2 mr-2 title"><i class="fas fa-paw icon"></i>クーポンを使用</h5>
        
        <div class="row no-gutter pt-0 pl-2 pr-2 mx-auto">
            <div class="mb-2">
                <p class="m-0">
                この度は {{ $candidate->place_name }} のペットを購入していただき、ありがとうございます。
                新しい家族とかけがえのない時間をお過ごし下さい。
                </p>
            </div>
            
            <div class="col-lg-7 col-10 mx-auto" style="position:relative;">
                <div class=" w-25 mx-auto border border-dark rounded small text-center pl-1 pr-1" style="position:absolute; top:0; left:0; right:0; background-color:khaki; z-index:1;">
                    <p class="m-0">内容</p>
                </div>
                
                <div class="border border-dark rounded p-3" style="position:absolute; top:10px; left:0; right:0; background-color:snow;">
                    <p class="m-0">{{ $candidate->coupon}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection