@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.setting') }}" novalidate="novalidate" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                            <li class="nav-item mr-3">
                                <a class="nav-link active" data-toggle="tab" href="#tab_1">
                                    <span class="nav-text font-size-lg">Cấu hình chung</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#tab_2">
                                    <span class="nav-text font-size-lg">Email</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active px-7" id="tab_1">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7 my-2">
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Tiêu đề
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="title" value="{{ old('title',setting('title')) }}">
                                            @error('title')
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
                                            Keyword
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="keyword"
                                                   value="{{ old('keyword',setting('keyword')) }}">
                                            @error('keyword')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="keyword" data-validator="notEmpty"
                                                     class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Description
                                        </label>
                                        <div class="col-9">
                                            <textarea class="form-control form-control-lg form-control-solid"
                                                      cols="30" rows="3"
                                                      name="description"
                                            >{{ old('description',setting('description')) }}</textarea>
                                            @error('description')
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
                                            Logo
                                        </label>
                                        <div class="col-9">
                                            <div
                                                style="cursor:pointer; position: relative; width: 100px; height: 100px; line-height: 30px; text-align: center;">
                                                <div class="images-preview preview-logo">
                                                    @if(isset($settings['logo']))
                                                        <img
                                                            src="{{ \App\Libraries\Helpers::getFileUrl($settings['logo']['path'], $settings['logo']['disk'])  }}">
                                                    @else
                                                        <img src="{{asset('images/default.png')}}">
                                                    @endif
                                                </div>
                                                <input id="app_logo" name="logo" type="file"
                                                       style="opacity: 0.0; position: absolute; top:0; left: 0; bottom: 0; right:0; width: 100%; height:100%;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Favicon
                                        </label>
                                        <div class="col-9">
                                            <div
                                                style="cursor:pointer; position: relative; width: 100px; height: 100px; line-height: 30px; text-align: center;">
                                                <div class="images-preview preview-favicon">
                                                    @if(isset($settings['favicon']))
                                                        <img
                                                            src="{{ \App\Libraries\Helpers::getFileUrl($settings['favicon']['path'], $settings['favicon']['disk'])  }}">
                                                    @else
                                                        <img src="{{asset('images/default.png')}}">
                                                    @endif
                                                </div>
                                                <input id="app_favicon" name="favicon" type="file"
                                                       style="opacity: 0.0; position: absolute; top:0; left: 0; bottom: 0; right:0; width: 100%; height:100%;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane px-7" id="tab_2">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7 my-2">
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">
                                            Mail From Address
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="mail_from_address"
                                                   value="{{ old('mail_from_address',setting('mail_from_address')) }}">
                                            @error('mail_from_address')
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
                                            Mail From Name
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="mail_from_name"
                                                   value="{{ old('mail_from_name',setting('mail_from_name')) }}">
                                            @error('mail_from_name')
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
                                            Mail Host
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="mail_host"
                                                   value="{{ old('mail_host',setting('mail_host')) }}">
                                            @error('mail_host')
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
                                            Mail Port
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="mail_port"
                                                   value="{{ old('mail_port',setting('mail_port')) }}">
                                            @error('mail_port')
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
                                            Mail Username
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="text" name="mail_username"
                                                   value="{{ old('mail_username',setting('mail_username')) }}">
                                            @error('mail_username')
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
                                            Mail Password
                                        </label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   type="password" name="mail_password"
                                                   value="{{ old('mail_password',setting('mail_password')) }}">
                                            @error('mail_password')
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
                                            Mail Encryption
                                        </label>
                                        <div class="col-9">
                                            <select class="form-control" name="mail_encryption">
                                                <option value="tls">TLS</option>
                                                <option value="ssl">SSL</option>
                                            </select>
                                            @error('mail_encryption')
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
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success mr-2">Lưu</button>
                        <button type="button" class="btn btn-secondary">Thoát</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('styles')
    <style>
        .images-preview img {
            width: 100px;
            height: 100px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(function () {
            var previewImages = function (input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#app_logo').on('change', function () {
                $('.preview-logo').html('');
                previewImages(this, 'div.preview-logo');
            });
            $('#app_favicon').on('change', function () {
                $('.preview-favicon').html('');
                previewImages(this, 'div.preview-favicon');
            });
        });
    </script>
@endpush
