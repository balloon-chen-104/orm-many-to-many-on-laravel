@extends('layouts.app')

@section('content')

    <h1>編輯履歷</h1>
    {!! Form::open(['action' => ['ResumesController@update', $resume->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', '標題')}}
            {{Form::text('resume', "$resume->resume", ['class' => 'form-control', 'placeholder' => '請輸入標題'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', '內文')}}
            {{Form::textarea('resume_content', "$resume->resume_content", ['id' => 'resume-ckeditor', 'class' => 'form-control', 'placeholder' => '請輸入內文'])}}
        </div>
        <div class="form-group">
            @php
                $tagsInResume = [];
                foreach ($resume->tags as $tag) {
                    $tagsInResume[] = $tag->id;
                }
            @endphp
            @foreach ($tags as $tag)
                @if (in_array($tag->id, $tagsInResume))
                    {{Form::checkbox("tag.$tag->id", "$tag->id", true)}}
                @else
                    {{Form::checkbox("tag.$tag->id", "$tag->id")}}
                @endif
                {{Form::label("$tag->id", "$tag->tag")}}
            @endforeach
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('送出', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
    <a href="{{ route('resumes.show', $resume->id) }}" class="btn btn-outline-secondary">返回</a>

@endsection