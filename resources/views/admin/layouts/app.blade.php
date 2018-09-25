<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}
        <title>RIVo</title>
        <link rel="shortcut icon" href="{{ asset('favicon1.png') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
        <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
        <link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/jBox/jBox.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/jBox/jBox.Notice.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    </head>
    <body class="">
        <div id="app">

            @include('user.layouts.header')

            <div class="page-container">

                <!-- Page content -->
                <div class="page-content">

                    @if(auth()->check())
                        @include('admin.layouts.menu')
                    @endif

                    <div class="content-wrapper">

                        <!-- Content area -->
                        <div class="content">

                            @include('admin.layouts.status')

                            @yield('content')

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/vue.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="//unpkg.com/element-ui@2.4.5/lib/index.js"></script>
        @yield('script')
    </body>
</html>
