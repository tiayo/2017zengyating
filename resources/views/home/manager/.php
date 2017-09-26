<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>预约{{ $manager['name'] }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/style.css') }}"/>
    <script src="{{ asset('/style/home/js/jquery.min.js') }}"></script>
</head>
<body>
<div class="barber">
    <div class="banner">
        <img src="{{ $manager['avatar'] }}" class="banner-pic" />
        <h1>{{ $manager['name'] }}</h1>
    </div>
    <div class="date">
        @for($i=0; $i<7; $i++)
            <div class="date-list @if($i == 0) date-active @endif">
                <h1>{{ \Carbon\Carbon::parse(now()->addDay($i))->format('m-d') }}</h1>
                <h2>{{ config('site.week')[\Carbon\Carbon::now()->addDay($i)->dayOfWeek]}}</h2>
            </div>
        @endfor
    </div>
    <div class="time">
        <div class="time-con">
            <div class="timeTitle">
                <span></span>
                <em>上午</em>
                <span></span>
            </div>
            <ul class="time-info clearfix">
                <li>09:00</li>
                <li>10:00</li>
                <li>11:00</li>
                <li>12:00</li>
            </ul>
        </div>
        <div class="time-con">
            <div class="timeTitle">
                <span></span>
                <em>下午</em>
                <span></span>
            </div>
            <ul class="time-info clearfix">
                <li>13:00</li>
                <li>14:00</li>
                <li>15:00</li>
                <li>16:00</li>
                <li>17:00</li>
                <li>18:00</li>
            </ul>
        </div>
        <div class="time-con">
            <div class="timeTitle">
                <span></span>
                <em>晚上</em>
                <span></span>
            </div>
            <ul class="time-info clearfix">
                <li>19:00</li>
                <li>20:00</li>
                <li>21:00</li>
                <li>22:00</li>
                <li>23:00</li>
            </ul>
        </div>
    </div>
    <div class="confirm">
        <div class="confirm-info">
            预约时间：<span></span><em></em>
        </div>
        <a href="###" class="confirm-btn">确定</a>
    </div>
</div>
<script type="text/javascript">

    

    $(".date-list").on("click", function() {
        $(".date-list").removeClass('date-active');
        $(this).addClass('date-active');
        $(".confirm-info span").html($(this).children('h1').html());
    });

    $(".time-info li").on("click", function() {
        $(".time-info li").removeClass('time-active');
        $(this).addClass('time-active');
        $(".confirm-info em").html($(this).html());
    });
</script>
</body>
</html>