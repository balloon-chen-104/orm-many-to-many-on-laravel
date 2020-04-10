<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>resume</td>
            <td>{{$resume->resume}}</td>
        </tr>
        <tr>
            <td>resume content</td>
            <td>{{$resume->resume_content}}</td>
        </tr>
        <tr>
            <td>user id</td>
            <td>{{$resume->user->id}}</td>
        </tr>
        <tr>
            <td>user name</td>
            <td>{{$resume->user->name}}</td>
        </tr>
        @foreach ($resume->tags as $tag)
            <tr>
                <td>tag</td>
                <td>{{$tag->tag}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>