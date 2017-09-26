<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/style.css') }}"/>
    <script src="{{ asset('/style/home/js/jquery.min.js') }}"></script>
</head>
<body>
<div class="registration">
    <div id="logo">
        <img src="../icon/logo.png"/>
    </div>
    <div class="title">
        用户注册
    </div>
    <form action="{{ route('home.register') }}" method="post" id="form">
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
            <div id="password">
                <input type="password" name="password_confirmation" placeholder="请确认密码"/>
            </div>
            @foreach($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
        </div>
    </form>
    <div id="registration-button" onclick="document.getElementById('form').submit()">注册</div>
</div>
</body>
</html>