@extends('storefront.layouts.default')
@section('meta')
    <meta name="description" content="{{setting('description')}}">
    <meta name="keywords" content="{{setting('keyword')}}">
@endsection
@section('content')
    <div class="content">
        @include('storefront.layouts.partials._header_search', [
        'search' => $search
        ])
        @foreach($property as $key => $item)
            <div class="item mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="d-block w-100" src="{{asset('images/image1.png')}}" alt="First slide">
                        </div>
                        <div class="col-md-8 pt-3">
                            <ul>
                                {{--<li>--}}
                                    {{--<a class="navbar-brand" to="/khu-vuc/1">--}}
                                        {{--<span class="badge">Tag 1</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a class="navbar-brand" href="{{route('detail',$item->slug)}}">
                                        <h4>{{$item->title}}</h4>
                                    </a>
                                </li>
                                <li>Khu vực : {{$item->province->name ?? null}}</li>
                                <li>Địa chỉ : {{$item->address}}</li>
                                <li>Diện tích : {{number_format(floatval($item->area))}} m<sup>2</sup></li>
                                <li>Liên hệ : {{ $item->user->name ?? $item->customer->name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center m-5">
        {{ $property->links() }}
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/storefont/pages/area.css') }}" rel="stylesheet">
@endpush
