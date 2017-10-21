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
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    {{ config('site.title') }} 运营统计
                </header>
                <div class="panel-body">
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>门店数量</th>
                                <th>理发师数量</th>
                                <th>总营业额</th>
                                <th>预约数量</th>
                                <th>今天预约</th>
                                <th>会员总数</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $store_count }}</td>
                                    <td>{{ $manager_count }}</td>
                                    <td>{{ $all_price }}</td>
                                    <td>{{ $order_count }}</td>
                                    <td>{{ $today_count }}</td>
                                    <td>{{ $user_count }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </section>
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
