<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}
        <title>DSV</title>
        <link rel="shortcut icon" href="{{ asset('favicon1.png') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
        <link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/jBox/jBox.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/jBox/jBox.Notice.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">

            {{--@include('layouts.nav')--}}

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 left-menu">
                        <div class="row">
                            @if(auth()->check())
                                @include('admin.layouts.menu')
                            @endif
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row">

                            @include('admin.layouts.status')

                            @yield('content')

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        @yield('script')
    </body>
</html>