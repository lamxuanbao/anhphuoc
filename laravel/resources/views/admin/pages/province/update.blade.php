@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.province.update',$province->id) }}" novalidate="novalidate" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active px-7">
                            @include('admin.pages.province.partials._general')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Lưu</button>
                    <a href="{{route('admin.province')}}" class="btn btn-secondary">
                        Thoát
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
