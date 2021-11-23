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
                        <img alt="Logo" src="assets/media/logos/logo-light.png"/>
                    </a>
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
				<span class="svg-icon svg-icon svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
    </g>
</svg><!--end::Svg Icon--></span>			</button>
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
