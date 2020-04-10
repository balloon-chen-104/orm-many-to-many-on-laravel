@extends('layouts.app')

@section('content')
    
    {{-- Redis message start --}}
    <div class="alert alert-danger redis">{{$redis_message}}</div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            if($('.redis').text() == '快取存在，直接載入資料'){
                $('.redis').toggleClass("alert-danger");
                $('.redis').toggleClass("alert-success");
            }
            setTimeout(function(){
                $('.redis').hide();
            }, 1000);
        });
    </script>
    {{-- Redis message over --}}

    <h1>{{ $resume->resume }}</h1>
    {{-- <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br> --}}
    <div>
        {!! $resume->resume_content !!}
    </div>
    <hr>
    <h6>
        @php
            $tags = [];
            foreach ($resume->tags as $tag) {
                $tags[] = '#'.$tag->tag;
            }
            $tagsInString = join(" ", $tags);
        @endphp
        {{ $tagsInString }}
    </h6>
    <small>擁有者 {{$resume->user->name}} - {{date('y-m-d h:m:s',strtotime($resume->created_at))}}</small>
    {{-- <small>擁有者 {{$resume->user->name}} - {{ $resume->created_at }}</small> --}}
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $resume->user_id || Auth::user()->id == 1)
            <a href="{{ route('resumes.edit', $resume->id) }}" class="btn btn-outline-secondary">編輯</a>
            {!! Form::open(['action' => ['ResumesController@destroy', $resume->id], 'method' => 'post', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('刪除', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
    <a href="{{ route('resumes.index') }}" class="btn btn-outline-secondary">返回</a>

@endsection