<div class="sidebar sidebar-main">
    <div class="user-pan">
        <span class="pull-left mr-3">
            @if ($avatar = auth()->user()->avatar)
                @if (is_role('admin'))
                    <a href="/admin"><img src="{{ asset('storage/' . $avatar) }}" class="img-rounded"></a>
                @elseif (is_role('farmer'))
                    <a href="/farm/edit/important"><img src="{{ asset('storage/' . $avatar) }}" class="img-rounded"></a>
                @else
                    <a href="/user"><img src="{{ asset('storage/' . $avatar) }}" class="img-rounded"></a>
                @endif
            @else
                @if (is_role('admin'))
                    <a href="/admin"><img class="img-fluid" src="/img/user.png"></a>
                @elseif (is_role('farmer'))
                    <a href="/farm/edit/important"><img class="img-fluid" src="/img/user.png"></a>
                @else
                    <a href="/user"><img class="img-fluid" src="/img/user.png"></a>
                @endif
            @endif
        </span>
        <div class="text-capitalize">
            {{ auth()->user()->name }}
        </div>
        <div>
            {{ auth()->user()->role }}
        </div>
    </div>
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