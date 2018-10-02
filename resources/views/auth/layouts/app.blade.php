<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/custom.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('css/theme.css') }}" rel="stylesheet">--}}
</head>
<body>
    <div id="app-auth" class="row">

        @include('auth.layouts.header')

        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                @if(auth()->check())
                    @include('auth.layouts.menu')
                @endif

                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">

{{--                        @include('user.layouts.status')--}}

                        @yield('content')

                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    {{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>--}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--<script src="//unpkg.com/element-ui@2.4.5/lib/index.js"></script>--}}
    <script src="{{ asset('js/vue.js') }}"></script>
    @yield('script')
</body>
</html>
