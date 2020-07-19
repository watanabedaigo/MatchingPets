@extends('layouts.app')

@section('content')
    <h1>候補写真追加</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($candidatephoto, ['route' => 'candidatephoto.store']) !!}

                <div class="form-group">
                    {!! Form::label('candidate_id', '候補名:') !!}
                    {!! Form::text('candidate_id', null, ['class' => 'form-control']) !!}
                </div>
                <p>AWS s3との連携を調べて実装</p>
              
                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
                <p>{!! link_to_route('index','データ追加ページへ',[],['class' => 'btn btn-success mt-3']) !!}</p>

            {!! Form::close() !!}
        </div>
    </div>
@endsection