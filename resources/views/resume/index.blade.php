@extends('layout.resumeTagLayout')

@section('content')

<div align="center">
    <table>
        <thead>
            <tr>
                <th>TITLE</th>
                <th>CONTENT</th>
                <th><a href="/tags">TAG</a></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($resumes as $resume)
            <tr>
                <td><a href="{{ route('resumes.show', $resume->id) }}">{{ $resume->resume }}</a></td>
                <td>{{ $resume->resume_content }}</td>
                <td>
                @php
                    $tags = [];
                    foreach ($resume->tags as $tag) {
                        $tags[] = $tag->tag;
                    }
                    $tagsInString = join(", ", $tags);
                @endphp
                {{ $tagsInString }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('resumes.create') }}">add new resume</a>
</div>

@endsection