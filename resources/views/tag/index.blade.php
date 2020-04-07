<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/resume.css" />
    <title>tag</title>
</head>
<body>
    <div align="center">
        <table>
            <thead>
                <tr>
                    <th>TAG</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->tag }}</a></td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}">edit</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="post" style="display: inline">
                            @method('DELETE')
                            <input type="text" name="delete" value="{{ $tag->id }}" style="display: none">
                            <input type="submit" value="delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('tags.create') }}">add new tag</a>
        <br>
        <a href="{{ route('resumes.index') }}">go back to resumes</a>
    </div>
</body>
</html>