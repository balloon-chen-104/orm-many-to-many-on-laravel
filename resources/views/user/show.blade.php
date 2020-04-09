@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">基本資料</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <tr>
                            <td width="40%">姓名</td>
                            <td width="60%">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>電子信箱</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>生日</td>
                            <td>{{ $user->birthday }}</td>
                        </tr>
                        <tr>
                            <td>電話</td>
                            <td>{{ $user->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><a href="/user/{{$user->id}}/edit" class="btn btn-outline-secondary">編輯</a></td>
                        </tr>
                    </table>
                </div>
            </div>

            <br>

            @if(Auth::user()->id == 1)
                <div class="card">
                    <div class="card-header">所有會員(管理員)</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($users as $user)
                            @if ($user->id != 1)
                                <table class="table table-striped">
                                    <tr>
                                        <td width="40%">姓名</td>
                                        <td  width="60%">{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>電子信箱</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>生日</td>
                                        <td>{{ $user->birthday }}</td>
                                    </tr>
                                    <tr>
                                        <td>電話</td>
                                        <td>{{ $user->phoneNumber }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><a href="/user/{{$user->id}}/edit" class="btn btn-outline-secondary">編輯</a></td>
                                    </tr>
                                </table>
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
