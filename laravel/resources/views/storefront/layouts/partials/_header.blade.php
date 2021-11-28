<div class="container header">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('images/logo.png')}}"/>
                </a>
                <div class="collapse navbar-collapse flex-row-reverse">
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('area') }}" novalidate="novalidate" enctype="multipart/form-data">
                        <input class="form-control" name="title" style="width: 200px; padding-right: 30px"/>
                        <button type="submit" class="fa fa-search"
                                style="background: no-repeat;position: absolute;border: none;right: 20px;"></button>
                    </form>
                </div>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="header-dot"></div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-between bd-highlight mb-3">
                <div class="p-2 bd-highlight header-title">Phước đất nhà xưởng</div>
                <div class="p-2 bd-highlight">
                    <ul class="header-nav">
                        @auth('customers')
                            <li>
                                <a href="{{route('auth.me')}}">Thông tin</a>
                            </li>
                            <li>
                                <a href="{{route('auth.property')}}">Bất động sản</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}">Thoát</a>
                            </li>
                        @endauth
                        @guest('customers')
                            <li>
                                <a href="{{route('register')}}">Đăng ký</a>
                            </li>
                            <li>
                                <a href="{{route('login')}}">Đăng nhập</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <link href="{{ asset('css/storefont/partials/header.css') }}" rel="stylesheet">
@endpush
