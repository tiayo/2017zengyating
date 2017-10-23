@extends('home.layouts.app')

@section('title', "$store->name")

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/swiper-3.4.1.min.css') }}"/>
    <script src="{{ asset('/style/home/js/swiper-3.4.1.jquery.min.js') }}"></script>
@endsection

@section('body')
<div class="store">
    <div class="swiper-container bigpic clearfix">
        {{--<div class="swiper-wrapper">--}}
            {{--<div class="swiper-slide">--}}
                {{--<img src="../images/1.jpg"/>--}}
            {{--</div>--}}
            {{--<div class="swiper-slide">--}}
                {{--<img src="../images/2.jpg"/>--}}
            {{--</div>--}}
            {{--<div class="swiper-slide">--}}
                {{--<img src="../images/1.jpg"/>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- 分页器 -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="barber-content">
        <div class="barberList clearfix">
            <div class="barberList-name">
                <h1>{{ $store['name'] }}</h1>
                <a href="tel:{{ $store['phone'] }}" class="tel"></a>
            </div>

            @foreach($managers as $manager)
                <div class="barberList-info clearfix">
                    <div class="barberList-info-top">
                        <img src="{{ $manager['avatar'] }}" class="portrait"/>
                        <h1>{{ $manager['name'] }}</h1>
                        <h2>{{ config('site.manager_group')[$manager['type']] }}</h2>
                    </div>
                    <div class="barberList-info-bottom clearfix">
                        <h1>{{ $manager['introduce'] }}~</h1>
                        <a href="{{ route('home_order', ['manager_id' => $manager['id']]) }}" class="subscribe">预约</a>
                    </div>
                    <a href="{{ route('home_order', ['manager_id' => $manager['id']]) }}" class="barberList-info-more">查看更多</a>
                </div>
            @endforeach

        </div>
    </div>
</div>
<script type="text/javascript">
    var swiper = $('.bigpic').swiper({
        direction: 'horizontal',
        loop: true,
        autoplay: 3000,
        autoplayDisableOnInteraction : false,
        // 分页器
        pagination: '.bigpic .swiper-pagination',
    });
</script>
@endsection