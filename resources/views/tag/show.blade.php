@extends('layout.resumeTagLayout')

@section('content')

<div align="center">
    <table>
        <thead>
            <tr>
                <th>TAG</th>
                <th>RESUMES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $tag->tag }}</td>
                <td>
                @php
                    $resumes = [];
                    foreach ($tag->resumes as $resume) {
                        $resumes[] = $resume->resume;
                    }
                    $resumesInString = join(", ", $resumes);
                @endphp
                {{ $resumesInString }}
                </td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('tags.index') }}">go back</a>
</div>

@endsection