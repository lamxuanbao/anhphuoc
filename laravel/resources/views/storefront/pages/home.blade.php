@extends('storefront.layouts.default')

@section('content')
    @include('storefront.layouts.partials._header')
    <div class="container">
        <div id="carouselHome" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active">
                    <i class="fa fa-circle"></i>
                </li>
                <li data-target="#carouselHome" data-slide-to="1">
                    <i class="fa fa-circle"></i>
                </li>
                <li data-target="#carouselHome" data-slide-to="2">
                    <i class="fa fa-circle"></i>
                </li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <ul>
                        <li>
                            <h3>Thuê nhà xưởng</h3>
                        </li>
                        <li>Khu vực : TP.HCM</li>
                        <li>Địa chỉ : Khu công nghiệp Nhị Xuân Hóc Môn</li>
                        <li>Diện tích : 3000m<sup>2</sup></li>
                    </ul>
                    <div class="item-img">
                        <img class="d-block w-100" src="images/image1.png" alt="First slide">
                    </div>
                    <button class="btn item-button">
                        Xem thêm
                        <i class="fa fa-long-arrow-right"></i>
                    </button>
                </div>
                <div class="carousel-item">
                    <ul>
                        <li>
                            <h3>Thuê nhà xưởng</h3>
                        </li>
                        <li>Khu vực : TP.HCM</li>
                        <li>Địa chỉ : Khu công nghiệp Nhị Xuân Hóc Môn</li>
                        <li>Diện tích : 3000m<sup>2</sup></li>
                    </ul>
                    <div class="item-img">
                        <img class="d-block w-100" src="images/image1.png" alt="First slide">
                    </div>
                    <button class="btn item-button">
                        Xem thêm
                        <i class="fa fa-long-arrow-right"></i>
                    </button>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
            <span class="prev-icon bg-none" aria-hidden="true">
                <i class="fa fa-caret-left"></i>
            </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
            <span class="next-icon bg-none" aria-hidden="true">
                <i class="fa fa-caret-right"></i>
            </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div id="carouselHomeTitle">Tin mới</div>
    </div>
    <div class="container">
        <div class="row area">
            <div class="col-md-4 text-center">
                <img src="images/longan.png" class="w-100"/>
                <div class="name">Long An</div>
            </div>
            <div class="col-md-4 text-center">
                <img
                    src="images/hochiminh.png"
                    class="w-100 active"
                />
                <div class="name">TP.HCM</div>
            </div>
            <div class="col-md-4 text-center">
                <img src="images/dongnai.png" class="w-100"/>
                <div class="name">Biên Hoà</div>
            </div>
            <div class="title">Khu Vực</div>
        </div>
    </div>
@endsection