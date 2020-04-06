<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit_resume</title>
</head>
<body>
    <p>EDIT RESUME</p>
    <form action="/resumes/{{ $id }}" method="get">
        @method('PUT')
        <div>
            <span>Title</span>
            <input type="text" name="resume" value="{{ $resume->resume }}">
        </div>
        <div>
            <span>Content</span>
            <input type="text" name="resume_content" value="{{ $resume->resume_content }}">
        </div>
        <div>
            <div>tags</div>
            @php
                $tagsInResume = [];
                foreach ($resume->tags as $tag) {
                    $tagsInResume[] = $tag->id;
                }
            @endphp
            @foreach ($tags as $tag)
                @if (in_array($tag->id, $tagsInResume))
                    <input type="checkbox" id="tag{{ $tag->id }}" name="tag{{ $tag->id }}" value="{{ $tag->id }}" checked>
                @else
                    <input type="checkbox" id="tag{{ $tag->id }}" name="tag{{ $tag->id }}" value="{{ $tag->id }}">
                @endif
                <label for="tag{{ $tag->id }}">{{ $tag->tag }}</label><br>
            @endforeach
        </div>
        <input type="submit" value="submit">
    </form>
    <a href="/resumes/{{ $id }}">go back</a>
</body>
</html>