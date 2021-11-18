<div class="container header-search">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('images/logo.png')}}"/>
                </a>
            </nav>
        </div>
    </div>
    <div class="d-flex flex-row">
        <div class="area">
            <div class="header-dot"></div>
            <div class="title">Khu Vực</div>
        </div>
        <div class="w-100">
            <div class="d-flex flex-row pb-3">
                <div class="col-md-9">
                    <input class="form-control" placeholder="Tên" class="w-100" />
                </div>
                <div class="col-md-3">
                    <select class="form-control select2" data-placeholder="Loại">
                        <option></option>
                        <option value="jack"> Jack (100) </option>
                        <option value="lucy"> Lucy (101) </option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row pb-3">
                <div class="col-md-4">
                    <select class="form-control select2" data-placeholder="Tỉnh/Thành">
                        <option></option>
                        <option value="jack"> Jack (100) </option>
                        <option value="lucy"> Lucy (101) </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control select2" data-placeholder="Diện tích">
                        <option></option>
                        <option value="jack"> Jack (100) </option>
                        <option value="lucy"> Lucy (101) </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control select2" data-placeholder="Giá">
                        <option></option>
                        <option value="jack"> Jack (100) </option>
                        <option value="lucy"> Lucy (101) </option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <div class="col-md-4 text-right">
                    <button class="btn btn-search">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <link href="{{ asset('css/storefont/partials/header_search.css') }}" rel="stylesheet">
@endpush
