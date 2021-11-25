@extends('storefront.layouts.default')

@section('content')
    @include('storefront.layouts.partials._header')
    <aside class="col-sm-4 mx-auto">
        <div class="card">
            <article class="card-body">
                <h4 class="card-title mb-4 mt-1 text-center color-main">Đăng Ký</h4>
                <form method="POST" action="{{ route('register') }}" novalidate="novalidate" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label>Tên</label>
                        <input name="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input name="phone" class="form-control" value="{{old('phone')}}">
                        @error('phone')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" class="form-control" type="email" value="{{old('email')}}">
                        @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" type="password" name="password">
                        @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        Bạn đã có tài khoản.
                        <a class="float-right" href="{{route('login')}}">Đăng nhập</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-main"> Đăng ký</button>
                    </div>
                </form>
            </article>
        </div>

    </aside>
@endsection
