@extends('layouts.app')

@section('content')
    <h1>{{ $candidate->id }}の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($candidate, ['route' => ['candidate.update',$candidate->id],'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('variety_id', '品種ID:') !!}
                    {!! Form::text('variety_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('price', '値段:') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('age', '年齢:') !!}
                    {!! Form::text('age', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('gender', '性別:') !!}
                    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('personality', '性格:') !!}
                    {!! Form::text('personality', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('personality_details', '性格特徴:') !!}
                    {!! Form::text('personality_details', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('inspection', '検査の実施:') !!}
                    {!! Form::text('inspection', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('place_name', 'ペットショップ、保健所名:') !!}
                    {!! Form::text('place_name', null, ['class' => 'form-control']) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('place_address', '住所:') !!}
                    {!! Form::text('place_address', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('place_phonenumber', '電話番号:') !!}
                    {!! Form::text('place_phonenumber', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bussinesshours', '営業時間:') !!}
                    {!! Form::text('bussinesshours', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('place_id', '都道府県ID:') !!}
                    {!! Form::text('place_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('place_details_id', '市区町村ID:') !!}
                    {!! Form::text('place_details_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('coupon', 'クーポン:') !!}
                    {!! Form::text('coupon', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
                <p>{!! link_to_route('index','データ追加ページへ',[],['class' => 'btn btn-success mt-3']) !!}</p>

            {!! Form::close() !!}
        </div>
    </div>

@endsection