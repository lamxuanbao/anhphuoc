@extends('admin.layouts.default')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <a href="#" class="text-center mb-10">
                        <img src="assets/media/logos/logo-letter-1.png" class="max-h-70px" alt=""/>
                    </a>
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                        Discover Amazing Metronic<br/>
                        with great build tools
                    </h3>
                </div>
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                     style="background-image: url(assets/media/svg/illustrations/login-visual-1.svg)"></div>
            </div>
            <div
                class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <div class="d-flex flex-column-fluid flex-center">
                    <div class="login-form login-signin">
                        <form method="POST" action="{{ route('admin.login') }}" id="kt_login_signin_form" novalidate="novalidate" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                    Chào mừng
                                </h3>
                            </div>
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text"
                                       name="email" autocomplete="off" value="{{ old('email') }}"/>
                                @error('email')
                                <div class="fv-plugins-message-container">
                                    <div data-field="email" data-validator="notEmpty" class="fv-help-block">
                                        {{ $message }}
                                    </div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Mật khẩu</label>
                                </div>

                                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password"
                                       name="password" {{ old('password') }} autocomplete="off"/>
                                @error('password')
                                <div class="fv-plugins-message-container">
                                    <div data-field="email" data-validator="notEmpty" class="fv-help-block">
                                        {{ $message }}
                                    </div>
                                </div>
                                @enderror
                            </div>
                            <div class="pb-lg-0 pb-5">
                                <button type="submit" id="kt_login_signin_submit"
                                        class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                    Đăng nhập
                                </button>
                            </div>
                        </form>
                    </div>
{{--                    <div class="login-form login-forgot">--}}
{{--                        <form class="form" novalidate="novalidate" id="kt_login_forgot_form">--}}
{{--                            <div class="pb-13 pt-lg-0 pt-5">--}}
{{--                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password--}}
{{--                                    ?</h3>--}}
{{--                                <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your--}}
{{--                                    password</p>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"--}}
{{--                                       type="email" placeholder="Email" name="email" autocomplete="off"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-group d-flex flex-wrap pb-lg-0">--}}
{{--                                <button type="button" id="kt_login_forgot_submit"--}}
{{--                                        class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit--}}
{{--                                </button>--}}
{{--                                <button type="button" id="kt_login_forgot_cancel"--}}
{{--                                        class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/pages/login/login-1.css') }}" rel="stylesheet">
@endpush
