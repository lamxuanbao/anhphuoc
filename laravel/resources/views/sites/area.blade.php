@extends('layouts.app')

@section('content')
    <div class="content">
        @include('sites.partials.header_search')
        @for($i=0;$i<5;$i++)
            <div class="item mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="d-block w-100" src="images/image1.png" alt="First slide">
                        </div>
                        <div class="col-md-8 pt-3">
                            <ul>
                                <li>
                                    <a class="navbar-brand" to="/khu-vuc/1">
                                        <span class="badge">Tag 1</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="navbar-brand" to="/khu-vuc/1">
                                        <h4>Cho thue nha xuong</h4>
                                    </a>
                                </li>
                                <li>Diện tích :</li>
                                <li>Liên hệ :</li>
                                <li>Ngày hết hạn :</li>
                                <li>Còn lại :</li>
                                <li>Xem tin :</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/sites/area.css') }}" rel="stylesheet">
@endpush
