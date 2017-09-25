<form action="{{ route('home.login') }}" method="post">
    {{ csrf_field() }}

    email:<input type="email" name="email"><br>

    密码:
    <input type="password" class="form-control" name="password" autoComplete="off">

    <button type="submit">注册</button>
</form>
