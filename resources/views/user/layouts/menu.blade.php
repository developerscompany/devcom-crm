<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">

    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <div class="icn-wrapper d-inline-block">
                        <span class="text-under-icn kab-icn-text">
                            Кабінет
                        </span>
                    </div>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Увійти') }}</a>
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Зареєструватись') }}</a>
                </div>
            </li>
        @else
            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <div class="icn-wrapper d-inline-block">
                        Menu
                    </div>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (is_role('admin'))
                        <a class="dropdown-item" href="/admin/bids">Адмін</a>
                    @else
                        <a class="dropdown-item" href="/user"> {{ auth()->user()->name }} </a>
                    @endif

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Вийти') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>