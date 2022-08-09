@extends('layouts.app')

@section('title') Privacy policy @endsection

@section('logo')
<img src="http://127.0.0.1:8000/assets/images/logo-3.png" alt="">
@endsection

{{-- import css --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/list_tour/tour.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/list_tour/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}">
@endsection

{{-- header-content --}}
@section('header-content')
    <div class="row">
        <div class="content-header width-default">
            <strong>Privacy policy</strong>
        </div>
    </div>
@endsection

{{-- main-content --}}
@section('content')
    <div class="container wrap-content width-default">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" class="firt-link">Home</a>
                    <div class="next-link">
                        <img src="assets/icons/outline/Ellipse.png" alt="">
                        <a href="#">Privacy policy</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5 mb-5">
                {!! $privacy_policy !!}
            </div>
        </div>
    </div>
@endsection

{{-- import js --}}
@section('script')
    
@endsection
