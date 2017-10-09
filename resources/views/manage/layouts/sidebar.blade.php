<!--sidebar nav start-->
<ul style="margin-top:100px;" class="nav nav-pills nav-stacked custom-nav">

    <li class="menu-list" id="nav_3">
        <a href="#" onclick="location='{{ route('manage') }}'"><i class="fa fa-star"></i> <span>主页</span></a>
    </li>

    <li class="menu-list active nav-active" id="nav_0"><a href=""><i class="fa fa-user"></i> <span>管理专区</span></a>
        <ul class="sub-menu-list">
            <li id="nav_0_1"><a href="{{ route('manager_list') }}"><i class="fa fa-group"></i> 理发师管理</a></li>
            <li id="nav_0_2"><a href="{{ route('user_list') }}"><i class="fa fa-user"></i> 会员管理</a></li>
        </ul>
    </li>


</ul>
<!--sidebar nav end-->