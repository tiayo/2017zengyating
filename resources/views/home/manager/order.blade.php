<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>预约</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <script src="../js/jquery.min.js"></script>
</head>
<body>
<div class="barber">
    <div class="banner">
        <img src="../icon/portrait.jpg" class="banner-pic" />
        <h1>郑祥景</h1>
    </div>
    <div class="date">
        <div class="date-list date-active">
            <h1>10/6</h1>
            <h2>周一</h2>
        </div>
        <div class="date-list">
            <h1>10/7</h1>
            <h2>周二</h2>
        </div>
        <div class="date-list">
            <h1>10/8</h1>
            <h2>周三</h2>
        </div>
        <div class="date-list">
            <h1>10/9</h1>
            <h2>周四</h2>
        </div>
        <div class="date-list">
            <h1>10/10</h1>
            <h2>周五</h2>
        </div>
        <div class="date-list">
            <h1>10/11</h1>
            <h2>周六</h2>
        </div>
        <div class="date-list">
            <h1>10/12</h1>
            <h2>周日</h2>
        </div>
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