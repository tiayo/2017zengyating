<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>预约</title>
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
    <!--错误输出-->
    @foreach($errors->all() as $error)
        <script>
            alert('{{ $error }}');
        </script>
    @endforeach

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
                <li class="time-active">09:00</li>
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
        <div class="confirm-btn">确定</div>
    </div>
    <div class="barber-mask">
        <div class="mask-con">
            <h1>请选择您的预约项目</h1>
            <ul class="projects">
                @foreach($commodities as $commodity)
                    <li data-id="{{ $commodity['id'] }}">{{ $commodity['name'] }}</li>
                @endforeach
            </ul>
            <div class="mask-bottom">
                <span class="cancel">取消</span>
                <a href="#" class="mask-confirm">确定</a>
            </div>
        </div>
    </div>

    <form style="display: none" action="{{ route('home_order', ['manager_id' => Request::route('manager_id')]) }}"
          id="order_form" method="post">
        {{ csrf_field() }}
        <input type="text" name="order_time">
    </form>
</div>
<script type="text/javascript">
    window.onload = function() {
        $(".confirm-info span").html($('.date-active').children('h1').html());
        $(".confirm-info em").html($('.time-active').html());
    }
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

    $(".barber .barber-mask .projects li").on("click", function() {
        if(this.bool == true || this.bool == undefined) {
            $(this).addClass('projects-active');
            this.bool = false;
        } else {
            $(this).removeClass('projects-active');
            this.bool = true;
        }
    });

    $(".confirm-btn").on("click", function() {
        $(".barber-mask").show();
        $(".mask-bottom .cancel").on("click", function() {
            $(".barber-mask").hide();
        });
        $(".mask-bottom .mask-confirm").on("click", function() {
            if($(".projects-active").length < 1) {
                $(".barber .barber-mask h1").css({"color":"#f00","font-weight":"bold"});
            } else {

                var date = $('.date-active').children('h1').html();
                var time = $('.time-active').html();
                var form = $("#order_form");

                $("[name=order_time]").val({{ date('Y') }}+'-'+date+' '+time);

                $('.projects-active').each(function () {
                    form.append('<input type="text" name="commodity[]" value="'+$(this).attr("data-id")+'">')
                });

                form.submit();
            }
        });
    });
</script>
</body>
</html>