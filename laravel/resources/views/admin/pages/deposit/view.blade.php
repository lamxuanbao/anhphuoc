@extends('admin.layouts.default')

@section('content')
    <div class="container">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active px-7">
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">
                                    Tiêu đề
                                </label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid"
                                           type="text" disabled
                                           value="{{ old('name',$deposit->title) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">
                                    Nội dung
                                </label>
                                <div class="col-9">
                                    <textarea rows="5" class="form-control form-control-lg form-control-solid" disabled>{{$deposit->content}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">
                                    Hình ảnh
                                </label>
                                <div class="col-9">
                                    <ul class="list-images w-100">
                                        @foreach($deposit->images as $key => $image)
                                            <li data-id="{{$key}}">
                                                <img src="{{$image->url}}"><label
                                                    class="remove btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"> <i
                                                        class="fa fa-trash icon-sm text-muted"></i></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{route('admin.deposit')}}" class="btn btn-secondary">
                        Thoát
                    </a>
                </div>
            </div>
    </div>
@endsection
