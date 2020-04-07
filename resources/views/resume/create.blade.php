<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create_resume</title>
</head>
<body>
    <p>ADD RESUME</p>
    <form action="{{ route('resumes.store') }}" method="post">
        <div>
            <span>Title</span>
            <input type="text" name="resume">
        </div>
        <div>
            <span>Content</span>
            <input type="text" name="resume_content">
        </div>
        <div>
            <div>tags</div>
            @foreach ($tags as $tag)
                <input type="checkbox" id="tag{{ $tag->id }}" name="tag{{ $tag->id }}" value="{{ $tag->id }}">
                <label for="tag{{ $tag->id }}">{{ $tag->tag }}</label><br>
            @endforeach
        </div>
        <div>
            <input type="submit" value="submit">
        </div>
    </form>
    <a href="{{ route('resumes.index') }}">go back</a>
</body>
</html>