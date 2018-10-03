<div class="sidebar sidebar-main">
    <div class="sidebar-content">
{{--<div class="sidebar sidebar-main collapse" id="collapseExample" style="width: 100%;">--}}
        <ul class="nav navigation">
            <li class="{{ is_active('admin') }}">
                <a href="{{ url('admin') }}">
                    <img src="/img/dashboard.png" class="icon-menu" alt="">
                    <span class="item-menu">Головна</span>
                </a>
            </li>
            <li class="{{ is_active('admin/users') }}">
                <a href="{{ url('admin/users') }}">
                    <img src="/img/users.svg" style="color: black" class="icon-menu" alt="">
                    <span class="item-menu">Користувачі</span>
                </a>
            </li>
            <li class="{{ is_active('admin/transactions') }}">
                <a href="{{ url('admin/transactions') }}">
                    <i class="icon-home4"></i>
                    <span class="item-menu">Транзакції</span>
                </a>
            </li>
            <li class="{{ is_active('admin/bids') }}">
                <a href="{{ url('admin/bids') }}">
                    <img src="/img/bids.png" class="icon-menu" alt="">
                    <span class="item-menu">Біди</span>
                </a>
            </li>
            <li class="{{ is_active('admin/hosting') }}">
                <a href="#" onclick="showSub()">
                    <img src="/img/hosting.png" class="icon-menu" alt="">
                    <span class="item-menu">Хостинг</span>
                </a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('admin/hostings') }}">Список аккаунтів</a></li>
                        <li><a href="{{ url('admin/hostings/calendar') }}">Календар</a></li>
                        <li><a href="{{ url('admin/hostings/servers') }}">Сервери</a></li>
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