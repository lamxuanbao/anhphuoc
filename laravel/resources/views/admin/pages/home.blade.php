@extends('admin.layouts.default')

@section('content')
    @php
        echo \Request::route()->getName();
    @endphp
@endsection
