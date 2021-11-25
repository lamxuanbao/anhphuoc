@extends('storefront.layouts.default')

@section('content')
    @include('storefront.layouts.partials._header')
    <aside class="col-sm-4 mx-auto">
        <div class="card">
            <article class="card-body">
                <h4 class="card-title mb-4 mt-1 text-center color-main">Thông tin cá nhân</h4>
                <form method="POST" action="{{ route('auth.me') }}" novalidate="novalidate"
                      enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label>Tên</label>
                        <input name="name" class="form-control" value="{{old('name',$user->name)}}">
                        @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input name="phone" class="form-control" value="{{old('phone',$user->phone)}}">
                        @error('phone')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input disabled class="form-control" type="email" value="{{old('email',$user->email)}}">
                        @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu cũ</label>
                        <input class="form-control" type="password" name="password_old">
                        @error('password_old')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input class="form-control" type="password" name="password">
                        @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu mới</label>
                        <input class="form-control" type="password" name="password_confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-main">Lưu lại</button>
                    </div>
                </form>
            </article>
        </div>

    </aside>
@endsection
