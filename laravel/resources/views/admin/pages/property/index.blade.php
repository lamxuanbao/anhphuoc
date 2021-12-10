@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        Danh sách bất động sản
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{route('admin.property.create')}}" class="btn btn-primary font-weight-bolder">
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
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Ngày hết hạn</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($property as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td style="width: 150px;">
                                    @if($item->is_active)
                                        <span class="label label-inline label-light-success font-weight-bold">
                                            Đang hoạt động
                                        </span>
                                    @else
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            Đang chờ
                                        </span>
                                    @endif
                                </td>
                                <td style="width: 150px">
                                    {{($item->end_date != null) ? $item->end_date->format('d/m/Y') : ''}}
                                </td>
                                <td style="width: 150px;">
                                    <a href="{{route('admin.property.update',$item->id)}}">
                                        <span class="label label-inline label-light-success font-weight-bold">
                                            Chỉnh sửa
                                        </span>
                                    </a>
                                    <a href="{{route('admin.property.delete',$item->id)}}">
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            Xoá
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $property->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
