@extends('admin.layouts.default')

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        HTML Table
                        <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a href="#" class="btn btn-primary font-weight-bolder">
                        New Record
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..."
                                               id="kt_datatable_search_query">
                                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                                    </div>
                                </div>

                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                        <div class="dropdown bootstrap-select form-control"><select class="form-control"
                                                                                                    id="kt_datatable_search_status">
                                                <option value="">All</option>
                                                <option value="1">Pending</option>
                                                <option value="2">Delivered</option>
                                                <option value="3">Canceled</option>
                                                <option value="4">Success</option>
                                                <option value="5">Info</option>
                                                <option value="6">Danger</option>
                                            </select>
                                            <button type="button" tabindex="-1"
                                                    class="btn dropdown-toggle btn-light bs-placeholder"
                                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                                    aria-haspopup="listbox" aria-expanded="false"
                                                    data-id="kt_datatable_search_status" title="All">
                                                <div class="filter-option">
                                                    <div class="filter-option-inner">
                                                        <div class="filter-option-inner-inner">All</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                        <div class="dropdown bootstrap-select form-control"><select class="form-control"
                                                                                                    id="kt_datatable_search_type">
                                                <option value="">All</option>
                                                <option value="1">Online</option>
                                                <option value="2">Retail</option>
                                                <option value="3">Direct</option>
                                            </select>
                                            <button type="button" tabindex="-1"
                                                    class="btn dropdown-toggle btn-light bs-placeholder"
                                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-2"
                                                    aria-haspopup="listbox" aria-expanded="false"
                                                    data-id="kt_datatable_search_type" title="All">
                                                <div class="filter-option">
                                                    <div class="filter-option-inner">
                                                        <div class="filter-option-inner-inner">All</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">
                                Search
                            </a>
                        </div>
                    </div>
                </div>
                <div class="datatable datatable-default datatable-primary datatable-loaded">
                    <table class="datatable-bordered datatable-head-custom datatable-table" id="kt_datatable"
                           style="display: block;">
                        <thead class="datatable-head">
                        <tr class="datatable-row" style="left: 0px;">
                            <th class="datatable-cell">
                                Id
                            </th>
                            <th class="datatable-cell">
                                Tên
                            </th>
                            <th class="datatable-cell">
                                Số điện thoại
                            </th>
                            <th class="datatable-cell">
                                Email
                            </th>
                            <th class="datatable-cell">
                                Trạng thái
                            </th>
                            <th class="datatable-cell">

                            </th>
                        </tr>
                        </thead>
                        <tbody style="" class="datatable-body">
                        <tr data-row="0" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell">
                                1
                            </td>
                            <td class="datatable-cell">
                                1
                            </td>
                            <td class="datatable-cell">
                                1
                            </td>
                            <td class="datatable-cell">
                                1
                            </td>
                            <td class="datatable-cell">
                                1
                            </td>
                            <td class="datatable-cell">
                                1
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $customers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
