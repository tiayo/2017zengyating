@extends('manage.layouts.app')

@section('title', '添加/管理预约')

@section('style')
    @parent
    <link href="{{ asset('https://cdn.bootcss.com/flatpickr/2.5.6/flatpickr.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('https://cdn.bootcss.com/flatpickr/2.5.6/flatpickr.js') }}"></script>
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理专区</a></li>
    <li navValue="nav_0_4"><a href="#">添加/管理预约</a></li>
@endsection

@section('body')
    <div class="col-md-12">

        <!--错误输出-->
        <div class="form-group">
            <div class="alert alert-danger fade in @if(!count($errors) > 0) hidden @endif" id="alert_error">
                <a href="#" class="close" data-dismiss="alert">×</a>
                <span>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </span>
            </div>
        </div>

        <section class="panel">
            <header class="panel-heading">
                添加/管理预约
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="commodity" class="col-sm-2 col-sm-2 control-label">商品</label>
                        <div class="col-sm-3">
                            @foreach($commodities as $commodity)
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="commodity_{{ $commodity['id'] }}" name="commodity[]" value="{{ $commodity['id'] }}">{{ $commodity['name'] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="manager_id" class="col-sm-2 col-sm-2 control-label">理发师</label>
                        <div class="col-sm-3">
                            <select class="form-control m-bot15" id="manager_id" name="manager_id" required>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager['id'] }}">{{ $manager['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_time" class="col-sm-2 col-sm-2 control-label">时间</label>
                        <div class="col-sm-3">
                            <input type="hidden" name="order_time" value="date">
                            <input type="text" class="form-control" id="order_time" name="order_time"  value="{{ $old_input['order_time'] }}" placeholder="Select Time.." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div  class="col-sm-2 col-sm-2 control-label">
                            <button class="btn btn-success" type="submit"><i class="fa fa-cloud-upload"></i> 确认提交</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {
            //时间显示
            flatpickr("#order_time", {
                enableTime: true,
                altInput: true,
                altFormat: "Y-m-d H:00:00"
            });

            //商品选中
            @if (!empty($old_input['commodity']))
                    @php
                        $old_commodities = is_array($old_input['commodity']) ?
                            $old_input['commodity'] : unserialize($old_input['commodity'])
                    @endphp
                @foreach($old_commodities as $commodity)
                    $("#commodity_{{ $commodity }}").attr('checked', 'checked');
                @endforeach
            @endif

            $('#password').bind('input propertychange', function() {
                $(this).attr('name', 'password')
            })
        });
    </script>
    <script>

    </script>
@endsection
