<div class="sidebar sidebar-main">
    <div class="sidebar-content">
{{--<div class="sidebar sidebar-main collapse" id="collapseExample" style="width: 100%;">--}}
        <ul class="nav navigation">
            <li class="{{ is_active('admin') }} dash-menu-item menu-item">
                <a class="pl-5" href="{{ url('admin') }}">
                    {{--<img src="/img/dashboard.png" class="icon-menu" alt="">--}}
                    <span class="item-menu">Головна</span>
                </a>
            </li>
            <li class="{{ is_active('admin/users') }} users-menu-item menu-item">
                <a class="pl-5" href="{{ url('admin/users') }}">
                    {{--<img src="/img/users-grey.png" style="color: black" class="icon-menu" alt="">--}}
                    <span class="item-menu">Користувачі</span>
                </a>
            </li>
            <li class="{{ is_active('admin/transactions') }} trans-menu-item menu-item">
                <a class="pl-5" href="{{ url('admin/transactions') }}">
                    {{--<i class="icon-home4"></i>--}}
                    <span class="item-menu">Транзакції</span>
                </a>
            </li>
            <li class="{{ is_active('admin/bids') }} bids-menu-item menu-item">
                <a class="pl-5" href="{{ url('admin/bids') }}">
                    {{--<img src="/img/bids.png" class="icon-menu" alt="">--}}
                    <span class="item-menu">Біди</span>
                </a>
            </li>
            <li class="host-menu-item menu-item">
                <a href="#" onclick="showSub()" class="pl-5 {{ is_active('admin/hostings') }} {{ is_active('admin/hostings/calendar') }} {{ is_active('admin/hostings/servers') }}">
                    {{--<img src="/img/hosting.png" class="icon-menu" alt="">--}}
                    <span class="{{ is_active('admin/hostings') }} {{ is_active('admin/hostings/calendar') }} {{ is_active('admin/hostings/servers') }} item-menu" >Хостинг</span>
                </a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('admin/hostings') }}" class="{{ is_active('admin/hostings') }}">Список аккаунтів</a></li>
                        <li><a href="{{ url('admin/hostings/calendar') }}" class="{{ is_active('admin/hostings/calendar') }}">Календар</a></li>
                        <li><a href="{{ url('admin/hostings/servers') }}" class="{{ is_active('admin/hostings/servers') }}">Сервери</a></li>
                    </ul>

            </li>
        </ul>
    </div>
</div>
<style>
    .sub-menu{
        display: none;
    }
</style>
<script>
    function showSub() {
        this.$(".sub-menu").toggle()
    }
</script>