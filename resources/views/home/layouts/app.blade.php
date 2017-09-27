<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/style.css') }}"/>
    <script src="{{ asset('/style/home/js/jquery.min.js') }}"></script>
    @section('style')

    @show
</head>
<body>

@section('body')

@show

<div class="nav-right">
    <a href="/">回到首页</a>
    <a href="cn/personal-center.html">个人中心</a>
</div>

<script>
    $(".nav-right").on("click", function() {
        if(this.bool == true || this.bool == undefined) {
            $(this).animate({right:"0px"});
            this.bool = false;
        } else {
            $(this).animate({right:"-120px"});
            this.bool = true;
        }
    });
</script>

@section('script')

@show

</body>
</html>