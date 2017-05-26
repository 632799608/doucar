<div class="layui-header header header-demo">
    <div class="layui-main">
        <a class="logo" href="/admin">
            <img src="{{ asset('back/images/logo.png') }}" alt="layui">
        </a>
        <ul class="layui-nav" pc>
            <li class="layui-nav-item" pc>
                <a href="javascript:;">{{ $user['username'] }}</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('logout')}}"></a></dd>
                    <dd><a href="{{url('logout')}}">退出登录</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item" mobile>
                <a href="javascript:;">{{ $user['username'] }}</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('logout')}}">退出登录</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>