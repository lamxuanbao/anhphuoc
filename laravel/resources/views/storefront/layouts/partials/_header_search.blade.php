@php
    if(!isset($search)){
        $search = [
            'title'       => null,
            'price'       => null,
            'type'        => null,
            'province_id' => null,
            'area'        => null,
        ];
    }
@endphp
<div class="container header-search">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="dropdown">
                    <div class="navbar-brand dropdown-toggle" type="button" data-toggle="dropdown">
                        <img src="{{asset('images/logo.png')}}"/>
                    </div>
                    <ul class="dropdown-menu header-nav">
                        <a href="{{route('home')}}">
                            <li>
                                Trang chủ
                            </li>
                        </a>
                        <li class="dropdown-submenu">
                            <span class="test" tabindex="-1">
                                Khu vực <i class="fa fa-caret-right"></i>
                            </span>
                            <ul class="dropdown-menu header-nav">
                                @php
                                    $province = \App\Models\Province::all();
                                @endphp
                                @foreach($province as $item)
                                    <a href="{{ route('area') }}?title=&type=&province_id={{$item->id}}&area=&price=">
                                        <li class="{{($loop->last) ? 'border-none' : ''}}">
                                            {{$item->name}}
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                        <a href="{{route('deposit')}}">
                            <li class="border-none">
                                Kí gửi
                            </li>
                        </a>
                    </ul>
                </div>

                <div class="collapse navbar-collapse flex-row-reverse">
                    <div class="mr-auto">
                        <div class="p-2 bd-highlight">Phước đất nhà xưởng</div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="d-flex flex-row">
        <div class="area">
            <div class="header-dot"></div>
            <div class="title">Khu Vực</div>
        </div>
        <div class="w-100">
            <form method="GET" action="{{ route('area') }}" novalidate="novalidate"
                  enctype="multipart/form-data">
                <div class="d-flex flex-row pb-3">
                    <div class="col-md-9">
                        <input class="form-control" name="title" placeholder="Tên" class="w-100" value="{{$search['title']}}"/>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control select2" data-placeholder="Loại" name="type">
                            <option></option>
                            <option value="buy" {{($search['type'] == 'buy') ? 'selected="selected' : ''}}>Mua</option>
                            <option value="rent" {{($search['type'] == 'rent') ? 'selected="selected' : ''}}>Thuê</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-row pb-3">
                    <div class="col-md-4">
                        <select class="form-control select2" data-placeholder="Tỉnh/Thành" name="province_id">
                            <option></option>
                            @php
                                $province = \App\Models\Province::all();
                            @endphp
                            @foreach($province as $item)
                                <option value="{{$item->id}}" {{($search['province_id'] == $item->id) ? 'selected="selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control select2" data-placeholder="Diện tích" name="area">
                            <option></option>
                            @php
                                $area = [
                                    '<1000','1000-5000','>5000'
                                ]
                            @endphp
                            @foreach($area as $item)
                                <option value="{{$item}}">{{$item}} m<sup>2</sup></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="price" placeholder="Giá" class="w-100" value="{{$search['price']}}"/>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="col-md-4 text-right">
                        <button type="submit" class="btn btn-search">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('styles')
    <link href="{{ asset('css/storefont/partials/header_search.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.dropdown-submenu').on("click", function (e) {
                $(this).children('ul').toggle();
                e.stopPropagation();
            });
        });
    </script>
@endpush
