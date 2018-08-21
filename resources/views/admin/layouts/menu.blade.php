<div class="sidebar sidebar-main">
    <div class="sidebar-content">
{{--<div class="sidebar sidebar-main collapse" id="collapseExample" style="width: 100%;">--}}
        <ul class="nav navigation">
            <li class="{{ is_active('admin') }}">
                <a href="{{ url('admin') }}">
                    <i class="icon-home4"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ is_active('admin/users') }}">
                <a href="{{ url('admin/users') }}">
                    <i class="icon-home4"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="{{ is_active('admin/bids') }}">
                <a href="{{ url('admin/bids') }}">
                    <i class="icon-home4"></i>
                    <span>Біди</span>
                </a>
            </li>
            <li class="{{ is_active('admin/hosting') }}">
                <a href="{{ url('admin/hostings') }}">
                    <i class="icon-home4"></i>
                    <span>Хостинг</span>
                </a>
            </li>
        </ul>
    </div>
</div>