@extends('layouts.app')

@section('content')

    <h1>新增標籤</h1>
    {!! Form::open(['action' => 'TagsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', '標籤名稱')}}
            {{Form::text('tag', '', ['class' => 'form-control', 'placeholder' => '請輸入標籤名稱'])}}
        </div>
        {{Form::submit('送出', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
    <a href="{{ route('tags.index') }}" class="btn btn-outline-secondary">返回</a>
    
@endsection