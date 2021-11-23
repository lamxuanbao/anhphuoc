@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('admin.property.create')}}" class="btn btn-primary font-weight-bolder">
                        Tạo mới
                    </a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="datatable datatable-default datatable-primary datatable-loaded">
                    <table class="datatable-bordered datatable-head-custom datatable-table" id="kt_datatable"
                           style="display: block;">
                        <thead class="datatable-head">
                        <tr class="datatable-row" style="left: 0px;">
                            <th data-field="Order ID" class="datatable-cell datatable-cell-sort">
                                Id
                            </th>
                            <th data-field="Car Make" class="datatable-cell datatable-cell-sort">
                                Email
                            </th>
                        </tr>
                        </thead>
                        <tbody style="" class="datatable-body">
                        @foreach($customers as $customer)
                            <tr class="datatable-row" style="left: 0px;">
                                <td class="datatable-cell">
                                    {{ $customer->id }}
                                </td>
                                <td class="datatable-cell">
                                    {{ $customer->email }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $customers->links() !!}
                    </div>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    @php
        echo \Request::route()->getName();
    @endphp
    @foreach($customers as $customer)
        {{$customer->id}}
    @endforeach
    {{ $customers->links() }}
    <table class="table table-bordered mb-5">
        <thead>
        <tr class="table-success">
            <th scope="col">#</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <th scope="row">{{ $customer->id }}</th>
                <td>{{ $customer->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $customers->links() !!}
    </div>
@endsection
