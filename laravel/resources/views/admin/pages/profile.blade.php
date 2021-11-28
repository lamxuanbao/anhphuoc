@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.profile') }}" novalidate="novalidate" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active px-7">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7 my-2">
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Tên
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="name" value="{{ old('name',$user->name) }}">
                                            @error('name')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Số điện thoại
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="phone" value="{{ old('phone',$user->phone) }}">
                                            @error('phone')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Email
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" disabled value="{{ old('phone',$user->email) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Mật khẩu cũ
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="password" name="password_old" value="">
                                            @error('password_old')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Mật khẩu mới
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="password" name="password" value="">
                                            @error('password')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Nhập lại mật khẩu mới
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="password" name="password_confirmation" value="">
                                            @error('password_confirmation')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Lưu</button>
                    <button type="button" class="btn btn-secondary">Thoát</button>
                </div>
            </div>
        </form>
    </div>
@endsection
