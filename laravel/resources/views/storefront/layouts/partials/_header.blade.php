<div class="container header">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('images/logo.png')}}"/>
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-row-reverse">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control" style="width: 200px; padding-right: 30px"/>
                        <button class="fa fa-search"
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
                        <li>
                            Thoat
                            <!--<a @click="onLogout"> Thoát </a>-->
                        </li>
                        <li>
                            <a href="/dang-ky"> Đăng ký </a>
                        </li>
                        <li>
                            <a href="/dang-nhap"> Đăng nhập </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <link href="{{ asset('css/storefont/partials/header.css') }}" rel="stylesheet">
@endpush
