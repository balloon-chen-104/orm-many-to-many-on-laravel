@extends('layout.resumeTagLayout')

@section('content')

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

@endsection