<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit_tag</title>
</head>
<body>
    <p>EDIT TAG</p>
    <form action="/tags/{{ $id }}" method="get">
        <div>
            <span>Tag Name</span>
            <input type="text" name="tag" value="{{ $tag->tag }}">
            <input type="submit" value="submit">
        </div>
    </form>
    <br>
    <a href="/tags">go back</a>
</body>
</html>