@extends('home.layouts.app')

@section('title', '个人中心')

@section('body')
    @foreach($errors->all() as $error)
        <script>
            alert('{{ $error }}');
        </script>
    @endforeach
    <div class="pc">
        <div class="pc-banner">
            <div class="info">
                <img src="{{ $user['avatar'] }}" class="portrait" />
                <span class="name">{{ $user['name'] }}</span>
                <span class="id">ID:<em>{{ $user['id'] }}</em></span>
                <span class="member-type">
                    @php
                        $score = $user->profile->score;

                        foreach (config('site.user_level') as $key => $user_level) {
                            if ($score > $key) {
                                continue;
                            }

                            echo $user_level;

                            break;
                        }
                    @endphp
                </span>
            </div>
        </div>
        <ul>
            <li>
                我的积分
                <span>{{ $score }}</span>
            </li>
            <li>
                我的预约
                <div class="list">
                    @foreach($lists as $list)
                        <div class="list-info clearfix" >
                            <h1>{{ \App\Manager::find($list['manager_id'])->store->name }}</h1>
                            <h2>{{ $list['order_time'] }}</h2>
                            <h3>{{ $list->manager->name }}</h3>
                            <h4>{{ config('site.order_status')[$list['status']] }}</h4>
                            <h5>@foreach(unserialize($list['commodity']) as $commodity)
                                    <em>{{ \App\Commodity::select('name')->find($commodity)->name }}</em>
                                @endforeach
                            </h5>
                            <strong data-id="{{ $list['id'] }}">取消预约</strong>
                        </div>
                    @endforeach
                </div>
            </li>
        </ul>
        <div class="cancel-mask">
            <div class="cancel-con">
                <h1>确定取消预约？</h1>
                <span class="confirm">确定</span>
                <span class="cancel">取消</span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".pc ul li:nth-last-child(1) .list .list-info strong").on("click", function() {
            var order_id = $(this).attr('data-id');
            $(".pc .cancel-mask").show();
            $(".pc .cancel-mask .cancel-con .confirm").on("click", function() {
                $(location).attr('href', "{{ route('home_order_cancle', ['order_id' => '']) }}/" + order_id);
            });
            $(".pc .cancel-mask .cancel-con .cancel").on("click", function() {
                $(".pc .cancel-mask").hide();
            });
        });
    </script>
@endsection