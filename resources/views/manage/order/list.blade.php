@extends('manage.layouts.app')

@section('title', '预约管理')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    @if ($sign == 'admin')
        <li navValue="nav_0"><a href="#">管理员专区</a></li>
        <li navValue="nav_0_4"><a href="#">预约管理</a></li>
    @elseif($sign == 'manager')
        <li navValue="nav_1"><a href="#">管理员专区</a></li>
        <li navValue="nav_1_1"><a href="#">预约管理</a></li>
    @endif
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
                <form class="form-inline" id="search_form">
                    <div class="form-group">
                        <label class="sr-only" for="search"></label>
                        <input type="text" class="form-control" id="search" name="keyword"
                               value="{{ Request::get('keyword') }}" placeholder="输入用户姓名" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="salesman_search">搜索</button>
                </form>
            <header class="panel-heading">
                预约列表
            </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>用户</th>
		                    <th>商品</th>
		                    <th>总积分</th>
                            <th>总价格</th>
                            <th>预定时间</th>
                            <th>预定理发师</th>
                            <th>状态</th>
                            <th>创建时间</th>
							<th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($lists as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td>{{ $list->user->name }}</td>
                            <td>
                                @foreach(unserialize($list['commodity']) as $commodity)
                                    {{ \App\Commodity::select('name')->find($commodity)->name }} <br >
                                @endforeach
                            </td>
                            <td>{{ $list['score'] }}</td>
                            <td>{{ $list['price'] }}</td>
                            <td>{{ $list['order_time'] }}</td>
                            <td>{{ $list->manager->name }}</td>
                            <td>{{ config('site.order_status')[$list['status']] }}</td>
                            <td>{{ $list['created_at'] }}</td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" id="btnGroupDrop1">
                                        选择操作 <span class="caret"></span>
                                    </button>
                                    <ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu">
                                        @foreach(config('site.order_status') as $key => $order_status)
                                            <li>
                                                <a href="{{ route('order_status', ['order_id' => $list['id'], 'status' => $key]) }}"
                                                   onClick="return confirm('“确定”将会执行一系列不可恢复的操作，请选择：?');">
                                                    {{ $order_status }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if ($sign == 'admin')
                                    <button class="btn btn-info" type="button" onclick="location='{{ route('order_update', ['id' => $list['id'] ]) }}'">编辑</button>
                                    <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('order_destroy', ['id' => $list['id'] ]) }}'">删除</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
		        </table>

               {{ $lists->links() }}
            </div>
    	</section>
    </div>
</div>
@endsection

@section('script')
    @parent
    {{--转换搜索链接--}}
    <script type="text/javascript">
        $(document).ready(function () {

            $('#search_form').submit(function () {

                var keyword = $('#search').val();

                if (stripscript(keyword) == '') {
                    $('#search').val('');
                    return false;
                }

                window.location = '{{ $search_url }}/' + stripscript(keyword);

                return false;
            });

        });

        function stripscript(s)
        {
            var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
            var rs = "";
            for (var i = 0; i < s.length; i++) {
                rs = rs+s.substr(i, 1).replace(pattern, '');
            }
            return rs;
        }
    </script>
@endsection
