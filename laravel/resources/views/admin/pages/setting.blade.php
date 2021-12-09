@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.setting') }}" novalidate="novalidate" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-body">

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
                            Địa chỉ
                        </label>
                        <div class="col-9">
                            <input class="form-control form-control-lg form-control-solid"
                                   type="text" name="address"
                                   value="{{ old('address',setting('address')) }}">
                            @error('address')
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
                                   type="text" name="email"
                                   value="{{ old('email',setting('email')) }}">
                            @error('email')
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
                            Hotline
                        </label>
                        <div class="col-9">
                            <input class="form-control form-control-lg form-control-solid"
                                   type="text" name="hotline"
                                   value="{{ old('hotline',setting('hotline')) }}">
                            @error('hotline')
                            <div class="fv-plugins-message-container">
                                <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
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
