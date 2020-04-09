@extends('layouts.app')

@section('content')

    <h1>標籤</h1>
    @if (count($tags) > 0)
        @foreach ($tags as $tag)
            <div class="card card-body bg-light">
                <div class="row">
                    {{-- <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div> --}}
                    <div class="col-md-12 col-sm-12">
                        <h3><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->tag }}</a></h3>
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
                    </div>
                </div>
            </div>
        @endforeach
        <br>
        {{$tags->links()}}
    @else
        <p>沒有任何標籤</p>
    @endif

@endsection