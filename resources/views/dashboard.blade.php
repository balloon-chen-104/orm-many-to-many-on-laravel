@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">我的履歷</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($resumes) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>履歷</th>
                                <th>建立時間</th>
                            </tr>
                            @foreach ($resumes as $resume)
                                <tr>
                                    <td><a href="{{ route('resumes.show', $resume->id) }}">{{$resume->resume}}</a></td>
                                    <td>{{$resume->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>你尚未建立任何履歷</p>
                    @endif
                    <a href="{{ route('resumes.create') }}" class="btn btn-outline-secondary">新增履歷</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
