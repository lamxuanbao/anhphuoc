@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.property.create') }}" novalidate="novalidate" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                            <li class="nav-item mr-3">
                                <a class="nav-link active" data-toggle="tab" href="#tab_1">
                                    <span class="nav-text font-size-lg">Seo</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#tab_2">
                                    <span class="nav-text font-size-lg">Cấu hình chung</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#tab_3">
                                    <span class="nav-text font-size-lg">Hình ảnh</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active px-7" id="tab_1">
                            @include('admin.pages.property.partials._seo')
                        </div>
                        <div class="tab-pane px-7" id="tab_2">
                            @include('admin.pages.property.partials._general')
                        </div>
                        <div class="tab-pane px-7" id="tab_3">
                            @include('admin.pages.property.partials._image')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Lưu</button>
                    <a href="{{route('admin.property')}}" class="btn btn-secondary">
                        Thoát
                    </a>
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
// Multiple images preview with JavaScript
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
