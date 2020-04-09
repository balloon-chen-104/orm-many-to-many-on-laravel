@extends('layouts.app')

@section('content')
    
    <h1>{{ $tag->tag }}</h1>
    {{-- <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br> --}}
    <hr>
    <h6>
        @php
            $resumes = [];
            foreach ($tag->resumes as $resume) {
                $resumes[] = $resume->resume;
            }
            $resumesInString = join("、", $resumes);
        @endphp
        @if (count($resumes) > 1)
            {{ $resumesInString }}　都使用了這個標籤
        @elseif(count($resumes) == 1)
            {{ $resumesInString }}　使用了這個標籤
        @else
            沒有履歷使用這個標籤
        @endif
    </h6>
    <small>建立於 {{ $tag->created_at }}</small>
    <hr>
    @if(!Auth::guest())
        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-outline-secondary">編輯</a>
        {!! Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'post', 'class' => 'float-right']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('刪除', ['class' => 'btn btn-danger'])}}
        {!! Form::close() !!}
    @endif
    <a href="{{ route('tags.index') }}" class="btn btn-outline-secondary">返回</a>

@endsection