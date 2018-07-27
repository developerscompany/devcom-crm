<header class="container-fluid">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse row">
        <div class="navbar-header col-md-2">
            <a class="navbar-brand" href="/"><img src="/img/logo.png"></a>

            <ul class="nav navbar-nav d-block d-sm-none">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse col-md-3" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>
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
    <!-- /main navbar -->

</header>