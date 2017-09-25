<!--sidebar nav start-->
<ul style="margin-top:100px;" class="nav nav-pills nav-stacked custom-nav">
    @if(can('admin', null, 'manager'))
        <li class="menu-list" id="nav_0"><a href=""><i class="fa fa-user"></i> <span>管理专区</span></a>
            <ul class="sub-menu-list">
                <li id="nav_0_1"><a href="{{ route('manager_list') }}">理发师管理</a></li>
                <li id="nav_0_2"><a href="{{ route('manager_list') }}">会员管理</a></li>
                <li id="nav_0_3"><a href="{{ route('commodity_list') }}">商品管理</a></li>
                <li id="nav_0_4"><a href="{{ route('order_list') }}">预约管理</a></li>
            </ul>
        </li>
    @endif

    <li class="menu-list" id="nav_1"><a href=""><i class="fa fa-user"></i> <span>预约专区</span></a>
        <ul class="sub-menu-list">
            <li id="nav_1_1"><a href="{{ route('manager_order_list') }}">我的预约</a></li>
        </ul>
    </li>
</ul>
<!--sidebar nav end-->