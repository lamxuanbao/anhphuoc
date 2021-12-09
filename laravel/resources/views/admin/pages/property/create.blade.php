@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.property.create') }}" novalidate="novalidate" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-body">
                    <div class="tab-content">
                        @include('admin.pages.property.partials._seo')
                        @include('admin.pages.property.partials._general')
                        @include('admin.pages.property.partials._image')
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
