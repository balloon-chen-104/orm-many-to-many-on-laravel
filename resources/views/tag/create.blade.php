<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create_tag</title>
</head>
<body>
    <p>ADD NEW TAG</p>
    <form action="{{ route('tags.index') }}" method="post">
        <div>
            <span>Tag Name</span>
            <input type="text" name="tag">
            <input type="submit" value="submit">
        </div>
    </form>
    <br>
    <a href="{{ route('tags.index') }}">go back</a>
</body>
</html>