@extends('layouts.app')

@section('content')

    <h1>所有履歷</h1>
    @if (count($resumes) > 0)
        @foreach ($resumes as $resume)
            <div class="card card-body bg-light">
                <div class="row">
                    {{-- <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div> --}}
                    <div class="col-md-12 col-sm-12">
                        <h3><a href="{{ route('resumes.show', $resume->id) }}">{{ $resume->resume }}</a></h3>
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
                        <small>擁有者 {{$resume->user->name}} - {{ $resume->created_at }}</small>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
        {{$resumes->links()}}
    @else
        <p>沒有任何履歷</p>
    @endif

@endsection