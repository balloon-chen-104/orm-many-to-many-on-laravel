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