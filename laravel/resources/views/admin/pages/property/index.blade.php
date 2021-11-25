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
                            <th class="datatable-cell datatable-toggle-detail"><span></span></th>
                            <th data-field="Order ID" class="datatable-cell datatable-cell-sort"><span
                                    style="width: 134px;">Order ID</span></th>
                            <th data-field="Car Make" class="datatable-cell datatable-cell-sort"><span
                                    style="width: 134px;">Car Make</span></th>
                            <th data-field="Car Model" class="datatable-cell datatable-cell-sort"><span
                                    style="width: 134px;">Car Model</span></th>
                            <th data-field="Color" class="datatable-cell datatable-cell-sort"><span
                                    style="width: 134px;">Color</span></th>
                            <th data-field="Deposit Paid" class="datatable-cell datatable-cell-sort"><span
                                    style="width: 134px;">Deposit Paid</span></th>
                            <th data-field="Order Date" class="datatable-cell datatable-cell-sort"
                                style="display: none;"><span style="width: 134px;">Order Date</span></th>
                            <th data-field="Status" data-autohide-disabled="false"
                                class="datatable-cell datatable-cell-sort"><span style="width: 134px;">Status</span>
                            </th>
                            <th data-field="Type" data-autohide-disabled="false"
                                class="datatable-cell datatable-cell-sort"><span style="width: 134px;">Type</span></th>
                        </tr>
                        </thead>
                        <tbody style="" class="datatable-body">
                        <tr data-row="0" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell datatable-toggle-detail"><a class="datatable-toggle-detail"
                                                                                  href=""><i
                                        class="fa fa-caret-right"></i></a></td>
                            <td data-field="Order ID" aria-label="51785-424" class="datatable-cell"><span
                                    style="width: 134px;">51785-424</span></td>
                            <td data-field="Car Make" aria-label="Bentley" class="datatable-cell"><span
                                    style="width: 134px;">Bentley</span></td>
                            <td data-field="Car Model" aria-label="Continental" class="datatable-cell"><span
                                    style="width: 134px;">Continental</span></td>
                            <td data-field="Color" aria-label="Khaki" class="datatable-cell"><span
                                    style="width: 134px;">Khaki</span></td>
                            <td data-field="Deposit Paid" aria-label="$35290.47" class="datatable-cell"><span
                                    style="width: 134px;">$35290.47</span></td>
                            <td data-field="Order Date" aria-label="2017-12-04" class="datatable-cell"
                                style="display: none;"><span style="width: 134px;">2017-12-04</span></td>
                            <td data-field="Status" data-autohide-disabled="false" aria-label="1"
                                class="datatable-cell"><span style="width: 134px;"><span
                                        class="label font-weight-bold label-lg label-light-warning label-inline">Pending</span></span>
                            </td>
                            <td data-field="Type" data-autohide-disabled="false" aria-label="3" class="datatable-cell">
                                <span style="width: 134px;"><span
                                        class="label label-success label-dot mr-2"></span><span
                                        class="font-weight-bold text-success">Direct</span></span></td>
                        </tr>
                        <tr data-row="1" class="datatable-row datatable-row-even" style="left: 0px;">
                            <td class="datatable-cell datatable-toggle-detail"><a class="datatable-toggle-detail"
                                                                                  href=""><i
                                        class="fa fa-caret-right"></i></a></td>
                            <td data-field="Order ID" aria-label="55648-771" class="datatable-cell"><span
                                    style="width: 134px;">55648-771</span></td>
                            <td data-field="Car Make" aria-label="Buick" class="datatable-cell"><span
                                    style="width: 134px;">Buick</span></td>
                            <td data-field="Car Model" aria-label="LeSabre" class="datatable-cell"><span
                                    style="width: 134px;">LeSabre</span></td>
                            <td data-field="Color" aria-label="Violet" class="datatable-cell"><span
                                    style="width: 134px;">Violet</span></td>
                            <td data-field="Deposit Paid" aria-label="$56243.46" class="datatable-cell"><span
                                    style="width: 134px;">$56243.46</span></td>
                            <td data-field="Order Date" aria-label="2016-02-04" class="datatable-cell"
                                style="display: none;"><span style="width: 134px;">2016-02-04</span></td>
                            <td data-field="Status" data-autohide-disabled="false" aria-label="3"
                                class="datatable-cell"><span style="width: 134px;"><span
                                        class="label font-weight-bold label-lg label-light-primary label-inline">Canceled</span></span>
                            </td>
                            <td data-field="Type" data-autohide-disabled="false" aria-label="3" class="datatable-cell">
                                <span style="width: 134px;"><span
                                        class="label label-success label-dot mr-2"></span><span
                                        class="font-weight-bold text-success">Direct</span></span></td>
                        </tr>
                        <tr data-row="2" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell datatable-toggle-detail"><a class="datatable-toggle-detail"
                                                                                  href=""><i
                                        class="fa fa-caret-right"></i></a></td>
                            <td data-field="Order ID" aria-label="0187-0063" class="datatable-cell"><span
                                    style="width: 134px;">0187-0063</span></td>
                            <td data-field="Car Make" aria-label="Mercedes-Benz" class="datatable-cell"><span
                                    style="width: 134px;">Mercedes-Benz</span></td>
                            <td data-field="Car Model" aria-label="S-Class" class="datatable-cell"><span
                                    style="width: 134px;">S-Class</span></td>
                            <td data-field="Color" aria-label="Goldenrod" class="datatable-cell"><span
                                    style="width: 134px;">Goldenrod</span></td>
                            <td data-field="Deposit Paid" aria-label="$97306.72" class="datatable-cell"><span
                                    style="width: 134px;">$97306.72</span></td>
                            <td data-field="Order Date" aria-label="2017-11-06" class="datatable-cell"
                                style="display: none;"><span style="width: 134px;">2017-11-06</span></td>
                            <td data-field="Status" data-autohide-disabled="false" aria-label="5"
                                class="datatable-cell"><span style="width: 134px;"><span
                                        class="label font-weight-bold label-lg label-light-info label-inline">Info</span></span>
                            </td>
                            <td data-field="Type" data-autohide-disabled="false" aria-label="3" class="datatable-cell">
                                <span style="width: 134px;"><span
                                        class="label label-success label-dot mr-2"></span><span
                                        class="font-weight-bold text-success">Direct</span></span></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="datatable-pager datatable-paging-loaded">
                        <ul class="datatable-pager-nav my-2 mb-sm-0">
                            <li><a title="First" class="datatable-pager-link datatable-pager-link-first"
                                   data-page="1"><i class="flaticon2-fast-back"></i></a></li>
                            <li><a title="Previous" class="datatable-pager-link datatable-pager-link-prev"
                                   data-page="14"><i class="flaticon2-back"></i></a></li>
                            <li style="display: none;"><input type="text" class="datatable-pager-input form-control"
                                                              title="Page number"></li>
                            <li><a class="datatable-pager-link datatable-pager-link-number" data-page="11"
                                   title="11">11</a></li>
                            <li><a class="datatable-pager-link datatable-pager-link-number" data-page="12"
                                   title="12">12</a></li>
                            <li><a class="datatable-pager-link datatable-pager-link-number" data-page="13"
                                   title="13">13</a></li>
                            <li><a class="datatable-pager-link datatable-pager-link-number" data-page="14"
                                   title="14">14</a></li>
                            <li><a class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active"
                                   data-page="15" title="15">15</a></li>
                            <li><a title="Next"
                                   class="datatable-pager-link datatable-pager-link-next datatable-pager-link-disabled"
                                   data-page="15" disabled="disabled"><i class="flaticon2-next"></i></a></li>
                            <li><a title="Last"
                                   class="datatable-pager-link datatable-pager-link-last datatable-pager-link-disabled"
                                   data-page="15" disabled="disabled"><i class="flaticon2-fast-next"></i></a></li>
                        </ul>
                        <div class="datatable-pager-info my-2 mb-sm-0">
                            <div class="dropdown bootstrap-select datatable-pager-size" style="width: 60px;"><select
                                    class="selectpicker datatable-pager-size" title="Select page size" data-width="60px"
                                    data-container="body" data-selected="10">
                                    <option class="bs-title-option" value=""></option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light"
                                        data-toggle="dropdown" role="combobox" aria-owns="bs-select-19"
                                        aria-haspopup="listbox" aria-expanded="false" title="Select page size">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">
                                            <div class="filter-option-inner-inner">10</div>
                                        </div>
                                    </div>
                                </button>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-19" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="datatable-pager-detail">Showing 141 - 143 of 143</span></div>
                    </div>
                </div>
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
