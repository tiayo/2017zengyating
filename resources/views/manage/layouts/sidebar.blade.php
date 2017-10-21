<!--sidebar nav start-->
<ul style="margin-top:80px;" class="nav nav-pills nav-stacked custom-nav">

    @if(can('admin', null, 'manager'))
        <li class="menu-list active nav-active" id="nav_0"><a href=""><i class="fa fa-user"></i> <span>管理专区</span></a>
            <ul class="sub-menu-list">
                <li id="nav_0_1"><a href="{{ route('manager_list') }}"><i class="fa fa-group"></i> 理发师管理</a></li>
                <li id="nav_0_2"><a href="{{ route('user_list') }}"><i class="fa fa-user"></i> 会员管理</a></li>
                <li id="nav_0_3"><a href="{{ route('commodity_list') }}"><i class="fa fa-coffee"></i> 服务项目</a></li>
                <li id="nav_0_4"><a href="{{ route('order_list') }}"><i class="fa fa-pencil"></i> 预约管理</a></li>
                <li id="nav_0_5"><a href="{{ route('store_list') }}"><i class="fa fa-shopping-cart"></i> 门店管理</a></li>
            </ul>
        </li>
    @endif

    <li class="menu-list active nav-active" id="nav_1"><a href=""><i class="fa fa-star"></i> <span>预约专区</span></a>
        <ul class="sub-menu-list">
            <li id="nav_1_1"><a href="{{ route('manager_order_list') }}"><i class="fa fa-pinterest"></i> 我的预约</a></li>
        </ul>
    </li>

    <li class="menu-list">
        <a href="#" onclick="location='{{ route('manage.logout') }}'"><i class="fa fa-sign-out"></i> <span>退出登录</span></a>
    </li>
</ul>
<!--sidebar nav end-->