@extends('layout.resumeTagLayout')

@section('content')

<p>EDIT TAG</p>
<form action="{{ route('tags.update', $tag->id) }}" method="post">
    @method('PUT')
    <div>
        <span>Tag Name</span>
        <input type="text" name="tag" value="{{ $tag->tag }}">
        <input type="submit" value="submit">
    </div>
</form>
<br>
<a href="{{ route('tags.index') }}">go back</a>

@endsection