@extends('storefront.layouts.default')

@section('content')
    @include('storefront.layouts.partials._header')
    <aside class="col-sm-4 mx-auto">
        <div class="card">
            <article class="card-body">
                <h4 class="card-title mb-4 mt-1 text-center color-main">Đăng Nhập</h4>
                <form method="POST" action="{{ route('login') }}" novalidate="novalidate" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" class="form-control" type="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" type="password" name="password" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        Bạn chưa có tài khoản.
                        <a class="float-right" href="{{route('register')}}">Đăng ký</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-main"> Đăng nhập</button>
                    </div>
                </form>
            </article>
        </div>

    </aside>
@endsection
