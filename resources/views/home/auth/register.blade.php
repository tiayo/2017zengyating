@extends('home.layouts.app')

@section('title', '用户注册')

@section('body')
<div class="registration">
    <div id="logo">
        <img src="{{ asset('/style/home/images/logo.png') }}"/>
    </div>
    <div class="title">
        用户注册
    </div>
    <form action="{{ route('home.register') }}" enctype="multipart/form-data" method="post" id="form">
        {{ csrf_field() }}
        <div id="registration-dialog">
            <div id="user">
                <input type="email" name="email" placeholder="请输入邮箱"/>
            </div>
            <div id="user">
                <input type="text" name="name" placeholder="请输入名字"/>
            </div>
            <div id="user">
                <input type="password" name="password" placeholder="请输入密码"/>
            </div>
            <div id="user">
                <input type="password" name="password_confirmation" placeholder="请确认密码"/>
            </div>
            <div id="password">
                <input type="file" name="avatar"/>
            </div>
            @foreach($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
        </div>
    </form>
    <div id="registration-button" onclick="document.getElementById('form').submit()">注册</div>
</div>
@endsection