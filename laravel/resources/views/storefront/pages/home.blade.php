@extends('storefront.layouts.default')
@section('meta')
    <meta name="description" content="{{setting('description')}}">
    <meta name="keywords" content="{{setting('keyword')}}">
@endsection
@section('content')
    @include('storefront.layouts.partials._header')
    @if(count($property) > 0)
    <div class="container">
        <div id="carouselHome" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($property as $key => $item)
                <li data-target="#carouselHome" data-slide-to="{{$key}}" class="{{($key == 0) ? 'active' : ''}}">
                    <i class="fa fa-circle"></i>
                </li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($property as $key => $item)
                <div class="carousel-item {{($key == 0) ? 'active' : ''}}">
                    <ul>
                        <li>
                            <h3>{{$item->title}}</h3>
                        </li>
                        <li>Khu vực : {{$item->province->name ?? null}}</li>
                        <li>Địa chỉ : {{$item->address}}</li>
                        <li>Diện tích : {{number_format(floatval($item->area))}} m<sup>2</sup></li>
                    </ul>
                    <div class="item-img">
                        <img class="d-block w-100" src="images/image1.png" alt="First slide">
                    </div>
                    <a class="btn item-button" href="{{route('detail',$item->slug)}}">
                        Xem thêm
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                </div>
                @endforeach
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
    @endif
    <div class="container">
        <div class="row area">
            <div class="col-md-4 text-center">
                <img src="{{asset('images/longan.png')}}" class="w-100"/>
                <div class="name">Long An</div>
            </div>
            <div class="col-md-4 text-center">
                <img
                    src="{{asset('images/hochiminh.png')}}"
                    class="w-100 active"
                />
                <div class="name">TP.HCM</div>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{asset('images/dongnai.png')}}" class="w-100"/>
                <div class="name">Biên Hoà</div>
            </div>
            <div class="title">Khu Vực</div>
        </div>
    </div>
    @include('storefront.layouts.partials._footer')
@endsection
