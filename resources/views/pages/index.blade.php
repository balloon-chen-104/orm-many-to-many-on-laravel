@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>看看履歷</h1>
        <p>擁有你的專屬履歷 - 建立你的履歷或者瀏覽別人的履歷</p>
        @guest
            <p>
                <a href="/login" class="btn btn-primary btn-lg" role="button">登入</a>
                <a href="/register" class="btn btn-success btn-lg" role="button">註冊</a>
            </p>
        @else
            <p>
                <a href="{{ route('resumes.index') }}" class="btn btn-primary btn-lg" role="button">瀏覽履歷</a>
                <a href="{{ route('resumes.create') }}" class="btn btn-success btn-lg" role="button">新增履歷</a>
            </p>
        @endguest
    </div>
@endsection