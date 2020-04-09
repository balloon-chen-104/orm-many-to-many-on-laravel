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
                            <td>姓名</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>電子信箱</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'post', 'class' => 'float-right']) !!}
                            <tr>
                                <td>生日</td>
                                <td>{{Form::text('birthday', "$user->birthday", ['class' => 'form-control', 'placeholder' => 'yyyy/mm/dd'])}}</td>
                            </tr>
                            <tr>
                                <td>電話</td>
                                <td>{{Form::text('phoneNumber', "$user->phoneNumber", ['class' => 'form-control', 'placeholder' => '09xx-xxx-xxx'])}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    {{Form::hidden('_method', 'PUT')}}
                                    {{Form::submit('送出', ['class' => 'btn btn-primary'])}}
                                    @if (Auth::user()->id == 1)
                                        <a href="/user/{{Auth::user()->id}}" class="btn btn-outline-secondary">返回</a>
                                    @else
                                        <a href="/user/{{$user->id}}" class="btn btn-outline-secondary">返回</a>
                                    @endif
                                </td>
                            </tr>
                        {!! Form::close() !!}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
