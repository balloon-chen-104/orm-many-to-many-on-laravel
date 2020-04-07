@extends('layout.resumeTagLayout')

@section('content')

<div align="center">
    <table>
        <thead>
            <tr>
                <th>TITLE</th>
                <th>CONTENT</th>
                <th>TAG</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $resume->resume }}</td>
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
                <td>
                    <a href="{{ route('resumes.edit', $resume->id) }}">edit</a>
                    <form action="{{ route('resumes.destroy', $resume->id) }}" method="post" style="display: inline">
                        @method('DELETE')
                        <input type="text" name="delete" value="{{ $resume->id }}" style="display: none">
                        <input type="submit" value="delete">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('resumes.index') }}">go back to resumes</a>
</div>

@endsection