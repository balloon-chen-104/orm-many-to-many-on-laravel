@extends('layouts.app')

@section('content')

    <h1>新增履歷</h1>
    {!! Form::open(['action' => 'ResumesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', '標題')}}
            {{Form::text('resume', '', ['class' => 'form-control', 'placeholder' => '請輸入標題'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', '內文')}}
            {{Form::textarea('resume_content', '', ['id' => 'resume-ckeditor', 'class' => 'form-control', 'placeholder' => '請輸入內文'])}}
        </div>
        <div class="form-group">
            @foreach ($tags as $tag)
                {{Form::checkbox("tag.$tag->id", "$tag->id")}}
                {{Form::label('tag', "$tag->tag")}}
            @endforeach
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        {{Form::submit('送出', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
    <a href="{{ route('resumes.index') }}" class="btn btn-outline-secondary">返回</a>
    
@endsection