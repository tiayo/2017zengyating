@extends('home.layouts.app')

@section('title', '用户登录')

@section('body')
<div class="login">
    <div id="logo">
        <img src="{{ asset('/style/home/images/logo.png') }}"/>
    </div>
    <div class="title">
        欢迎登录
    </div>

    <form action="{{ route('home.login') }}" method="post" id="form">
        {{ csrf_field() }}
        <div id="login-dialog">
            <div id="user">
                <input type="email" name="email" placeholder="请输入邮箱"/>
            </div>
            <div id="password">
                <input type="password" name="password" placeholder="请输入密码"/>
            </div>
            @foreach($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
        </div>
    </form>

    <div id="login-button" onclick="document.getElementById('form').submit()">登录</div>

    <a href="{{ route('home.register') }}" id="registration-button">注册</a>
</div>
<script type="text/javascript">

</script>
@endsection