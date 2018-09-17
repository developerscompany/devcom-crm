<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <ul class="nav navigation">
            <li class="{{ is_active('user/cab') }}">
                <a href="{{ url('user/cab') }}">
                    <i class="icon-home4"></i>
                    <span>Особистий кабінет</span>
                </a>
            </li>
            <li class="{{ is_active('user') }}">
                <a href="{{ url('user') }}">
                    <i class="icon-home4"></i>
                    <span>Біди</span>
                </a>
            </li>
        </ul>
    </div>
</div>