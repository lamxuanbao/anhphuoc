<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? '')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/themes/layout/header/base/light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/themes/layout/header/menu/light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/themes/layout/brand/dark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/themes/layout/aside/dark.css') }}" rel="stylesheet">
    @stack('styles')
    @yield('styles')
</head>
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >
@php
    $routeName = \Request::route()->getName();
@endphp
@if($routeName == 'admin.login')
    @yield('content')
@else
    @include('admin.layouts.partials._header_mobile')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto"  id="kt_aside">
                <div class="brand flex-column-auto " id="kt_brand">
                    <a href="index.html" class="brand-logo">
                        <img alt="Logo" src="{{asset('images/logo-light.png')}}"/>
                    </a>
                </div>
                @include('admin.layouts.partials._aside_menu')
            </div>
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('admin.layouts.partials._header')
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="d-flex flex-column-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.partials._quick_user')
    @include('admin.layouts.partials._scrolltop')
@endif
</body>
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('js/admin/scripts.bundle.js') }}"></script>
@stack('scripts')
@yield('scripts')
</html>
