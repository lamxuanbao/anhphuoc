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
            </div>
            <div class="card-body">
                <div class="datatable datatable-default datatable-primary datatable-loaded">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Email</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $item)
                            <tr>
                                <th scope="row">{{$item->name}}</th>
                                <th scope="row">{{$item->phone}}</th>
                                <th scope="row">{{$item->email}}</th>
                                <td>
                                    <a href="{{route('admin.customer.delete',$item->id)}}">
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
