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
                        <small>擁有者 {{$resume->user->name}} - {{date('y-m-d h:m:s',strtotime($resume->created_at))}}</small>
                        {{-- <small>擁有者 {{$resume->user->name}} - {{ $resume->created_at }}</small> --}}
                    </div>
                </div>
            </div>
        @endforeach
        <br>
        {{-- {{$resumes->links()}} --}}
    @else
        <p>沒有任何履歷</p>
    @endif

@endsection