@extends('storefront.layouts.default')
@section('meta')
    <meta name="description" content="{{$property->description}}">
    <meta name="keywords" content="{{$property->keyword}}">
@endsection
@section('content')
    <div class="content">
        @include('storefront.layouts.partials._header_search')
        <div class="item mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div id="carouselHome" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($property->images as $key => $item)
                                    <li data-target="#carouselHome" data-slide-to="{{$key}}"
                                        class="{{($key == 0) ? 'active' : ''}}">
                                        <i class="fa fa-circle"></i>
                                    </li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($property->images as $key => $item)
                                    <div class="carousel-item {{($key == 0) ? 'active' : ''}}">
                                        <div class="item-img">
                                            <img class="d-block w-100" src="{{$item['url']}}">
                                        </div>
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
                    </div>
                    <div class="col-md-8 pt-3">
                        <ul>
                            <li>
                                <a class="navbar-brand">
                                    <h4>{{$property->title}}</h4>
                                </a>
                            </li>
                            <li style="line-height: 20px">
                                {!! $property->content !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/storefont/pages/detail.css') }}" rel="stylesheet">
@endpush
