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
                            @if(isset($item->images[0]['url']))
                                <img class="d-block w-100" src="{{$item->images[0]['url']}}" alt="{{$item->title}}">
                            @else
                                <img class="d-block w-100" src="{{asset('images/default.png')}}" alt="{{$item->title}}">
                            @endif
                        </div>
                        <div class="col-md-8 pt-3">
                            <ul>
                                <li>
                                    <a href="{{route('detail',$item->slug)}}">
                                        <h4>{{$item->title}}</h4>
                                    </a>
                                </li>
                                <li>Diện tích : {{number_format(floatval($item->area))}} m<sup>2</sup></li>
                                <li>Liên hệ : {{ $item->user->phone ?? $item->customer->phone}}
                                    - {{ $item->user->name ?? $item->customer->name}}</li>
                                <li>Ngày hết hạn
                                    : {{($item->end_date != null) ? $item->end_date->format('d/m/Y') : \Illuminate\Support\Carbon::now()->format('d/m/Y')}}</li>
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
