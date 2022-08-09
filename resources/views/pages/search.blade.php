@extends('layouts.app')

@section('title') List Tour @endsection

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
            <p>Search hundreds of tours and more</p>
            <strong>Attractive tour and interesting experiences</strong>
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
                        <a href="#">Tour</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="slide-header">
                    <div class="sl-hd-title">
                        Attractive tour and interesting experiences
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if (!empty($tours))
            <div class="content">
                @foreach ($tours as $tour)
                <div class="wrap-item">
                    <div class="part-top">
                        <a href="{{ route('tour_detail', $tour->slug) }}">
                            <img src="{{ asset('storage/upload/'.$tour->image) }}" alt="">
                        </a>
                        <img src="{{ asset('assets/icons/outline/tamgiac.png') }}" alt="" class="flag">
                        <div class="rating">
                            <img src="{{ asset('assets/icons/outline/star.png') }}" alt="">
                            <span>{{ $review->getInfoRating($tour->id)['avg'] }}</span>
                        </div>
                    </div>
                    <div class="part-bot">
                        <div class="location">
                            <img src="{{ asset('assets/icons/outline/shape.png') }}" alt="">
                            <span>{{ $tour->destination->title }}</span>
                        </div>
                        <div class="title">
                            <a href="{{ route('tour_detail', $tour->slug) }}">{{ $tour->title }}</a>
                        </div>
                        <div class="sl2-item-info">
                            <div class="sl2-if-time">
                                <img src="{{ asset('assets/icons/outline/time.png') }}" alt="">
                                <span>{{ $tour->convertDuration($tour->duration) }}</span>
                            </div>
                            <div class="sl2-if-cost">from <strong>${{ $tour->price }}</strong></div>
                        </div>
                    </div>
                </div>
                @endforeach     
            </div>
            @else
                <h4 class="mt-5 mb-5 d-flex justify-content-center">No result</h4>
            @endif
        </div>

        <div class="wrap-paginate d-flex justify-content-end">
            {{ $tours->withQueryString()->links() }}
        </div>
    </div>
@endsection

{{-- import js --}}
@section('script')
    <script src="{{ asset('vendor/jquery.js') }}"></script>
    <script src="{{ asset('js/client/list_tour.js') }}"></script>
@endsection
