@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.setting') }}" novalidate="novalidate">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                            <li class="nav-item mr-3">
                                <a class="nav-link active" data-toggle="tab" href="#tab_1">
                                    <span class="nav-text font-size-lg">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#tab_2">
                                    <span class="nav-text font-size-lg">Profile 2</span>
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
                                                   type="text" value="{{ old('title',setting('title')) }}">
                                            @error('title')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="email" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane px-7" id="tab_2">
                            asdasd
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
