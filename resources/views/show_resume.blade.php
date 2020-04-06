<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 吃不到 css 資源 -->
    <link rel="stylesheet" type="text/css" href="css/resume.css" />
    <title>show_resume</title>
</head>
<body>
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
                        <a href="/resumes/{{ $resume->id }}/edit">edit</a>
                        <form action="/resumes" method="post" style="display: inline">
                            <input type="text" name="delete" value="{{ $resume->id }}" style="display: none">
                            <input type="submit" value="delete">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href='/resumes'>go back to resumes</a>
    </div>
</body>
</html>

<style>

* {
    margin: 10px;
}

table, th, td {
    border: 1px dashed black;
    text-align: center;
    vertical-align: middle;
}

th {
    font-weight: bold;
}

th, td {
    padding: 10px;
}

</style>