@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        Danh sách khách hàng
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{route('admin.province.create')}}" class="btn btn-primary font-weight-bolder">
                        Tạo mới
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable datatable-default datatable-primary datatable-loaded">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $item)
                            <tr>
                                <th scope="row">{{$item->name}}</th>
                                <td>
                                    <a href="{{route('admin.province.update',$item->id)}}">
                                        <span class="label label-inline label-light-success font-weight-bold">
                                            Chỉnh sửa
                                        </span>
                                    </a>
                                    <a href="{{route('admin.province.delete',$item->id)}}">
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            Xoá
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $customer->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
