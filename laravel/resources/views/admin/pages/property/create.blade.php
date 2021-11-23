@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.property.create') }}" novalidate="novalidate">
            {{ method_field('PUT') }}
            @csrf
            <div class="card card-custom">
                <div class="card-body">
                    @include('admin.pages.property.partials._form')
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Lưu</button>
                    <button type="button" class="btn btn-secondary">Thoát</button>
                </div>
            </div>
        </form>
    </div>
@endsection
