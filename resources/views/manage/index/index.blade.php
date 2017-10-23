@extends('manage.layouts.app')

@section('title', '主页')

@section('style')
    <!--dashboard calendar-->
    <link href="{{ asset('/static/adminex/css/clndr.css') }}" rel="stylesheet">
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_3"><a href="#">主页</a></li>
@endsection

@section('body')
    <div class="row">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body">
                    <div class="calendar-block ">
                        <div class="cal1">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!--statistics start-->
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel purple">
                        <div class="symbol">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">{{ $store_count }}</div>
                            <div class="title">门店数量</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel red">
                        <div class="symbol">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">{{ $manager_count }}</div>
                            <div class="title">理发师数量</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel blue">
                        <div class="symbol">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">{{ $all_price }}</div>
                            <div class="title">总营业额</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel green">
                        <div class="symbol">
                            <i class="fa fa-eye"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">{{ $order_count }}</div>
                            <div class="title">预约数量</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel red">
                        <div class="symbol">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">{{ $today_count }}</div>
                            <div class="title">今天预约</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel purple">
                        <div class="symbol">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">{{ $user_count }}</div>
                            <div class="title">会员总数</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--statistics end-->
        </div>
    </div>
@endsection

@section('script')
    @parent
    <!--Calendar-->
    <script src="{{ asset('/static/adminex/js/calendar/clndr.js') }}"></script>
    <script src="{{ asset('/static/adminex/js/calendar/evnt.calendar.init.js') }}"></script>
    <script src="{{ asset('/static/adminex/js/calendar/moment-2.2.1.js') }}"></script>
    <script src="{{ asset('http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js') }}"></script>

@endsection
