@extends('layouts.app')

@section('content')
    <div class="row no-gutters justify-content-center">
        <h5 class="col-10 pt-2 title text-center"><i class="fas fa-paw icon"></i>候補追加</h5>
        <div class="col-lg-7 col-10 category-container pt-0 pr-2 pl-2 mb-2">
            {!! Form::model($candidate, ['route' => 'candidate.store']) !!}
                <div class="form-group mb-1">
                    {!! Form::label('variety_id', '品種ID',['class' => 'm-0']) !!}
                    {!! Form::text('variety_id', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('price', '値段',['class' => 'm-0']) !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('birthday', '誕生日',['class' => 'm-0']) !!}
                    {!! Form::text('birthday', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('coat_color', '毛色',['class' => 'm-0']) !!}
                    {!! Form::text('coat_color', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('gender', '性別',['class' => 'm-0']) !!}
                    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('personality', '性格',['class' => 'm-0']) !!}
                    {!! Form::text('personality', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('personality_details', '性格詳細',['class' => 'm-0']) !!}
                    {!! Form::textarea('personality_details', null, ['class' => 'form-control', 'rows' => '5' , 'cols' => '1000']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('inspection', '検査の実施',['class' => 'm-0']) !!}
                    {!! Form::text('inspection', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('place_name', 'ペットショップ、保健所名',['class' => 'm-0']) !!}
                    {!! Form::text('place_name', null, ['class' => 'form-control']) !!}
                </div>
                
                 <div class="form-group mb-1">
                    {!! Form::label('place_address', '住所',['class' => 'm-0']) !!}
                    {!! Form::text('place_address', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('map', '地図（GoogleMap貼り付け）',['class' => 'm-0']) !!}
                    {!! Form::text('map', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('place_phonenumber', '電話番号',['class' => 'm-0']) !!}
                    {!! Form::text('place_phonenumber', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('bussinesshours', '営業時間',['class' => 'm-0']) !!}
                    {!! Form::textarea('bussinesshours', null, ['class' => 'form-control', 'rows' => '5' , 'cols' => '1000']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('URL', 'URL:') !!}
                    {!! Form::text('URL', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group mb-1">
                    {!! Form::label('coupon', 'クーポン') !!}
                    {!! Form::text('coupon', null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('追加', ['class' => 'btn add-btn']) !!}
            {!! Form::close() !!}
        </div>
        <p class="col-10 text-center">{!! link_to_route('index','戻る', [], ['class' => 'btn link-btn' , 'style' => 'text-decoration:none;']) !!}</p>
    </div>
@endsection