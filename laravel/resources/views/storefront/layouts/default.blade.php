<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/storefont/layoput.css') }}" rel="stylesheet">
    @stack('styles')
    @yield('styles')
</head>
<body>
@yield('content')
<div class="footer">
    <div class="container">
        <p>
            Copyright 2008-2015 datnhaxuong.com.vn. all rights reserved
        </p>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
@yield('scripts')
</html>