@extends('layouts.app')

@section('content')

    <h1>編輯標籤</h1>
    {!! Form::open(['action' => ['TagsController@update', $tag->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', '標籤名稱')}}
            {{Form::text('tag', "$tag->tag", ['class' => 'form-control', 'placeholder' => '請輸入標籤名稱'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('送出', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
    <a href="{{ route('tags.index') }}" class="btn btn-outline-secondary">返回</a>
    
@endsection