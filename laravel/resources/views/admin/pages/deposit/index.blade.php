@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        Danh sách ký gửi
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable datatable-default datatable-primary datatable-loaded">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deposit as $item)
                            <tr>
                                <th scope="row">{{$item->title}}</th>
                                <th>
                                    @if($item->status)
                                        <span class="label label-inline label-light-success font-weight-bold">
                                            Đã xem
                                        </span>
                                    @else
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            Đang chờ
                                        </span>
                                    @endif
                                </th>
                                <td>
                                    <a href="{{route('admin.deposit.view',$item->id)}}">
                                        <span class="label label-inline label-light-success font-weight-bold">
                                            Xem
                                        </span>
                                    </a>
                                    <a href="{{route('admin.deposit.delete',$item->id)}}">
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            Xoá
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $deposit->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
