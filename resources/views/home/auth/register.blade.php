<form action="{{ route('home.login') }}" method="post">
    {{ csrf_field() }}

    email:<input type="email" name="email"><br>

    用户名：<input type="text" name="name"><br>

    密码:
    <input type="password" class="form-control" name="password" style="display: none" disabled>
    <input type="password" class="form-control" name="password" autoComplete="off"><br>

    确认密码： <input type="password" class="form-control" name="password_confirmation" autoComplete="off"><br>

    <button type="submit">注册</button>
</form>
