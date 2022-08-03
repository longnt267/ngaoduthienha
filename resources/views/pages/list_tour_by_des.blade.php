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
            <strong>{{ $destination->title }}</strong>
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
                    <button class="btn-filter">Filter x</button>
                </div>
            </div>
        </div>

        <div class="wrap-filter hidden">
            <div class="fl-top">
                <span>FILTER BY</span>
                <button>CLEAR</button>
            </div>

            <div class="fl-bottom">
                <form action="{{ route('tour') }}" id="my-form">
                    <div class="wrapper">
                        <label>Budget: </label>
                        <div class="values">
                            <input type="text" id='range1' name="budget_min" >
                            <input type="text" id="range2" name="budget_max" >
                        </div>
                        <div class="slide-container">
                            <div class="slider-track"></div>
                            @if (request()->budget_min)
                            <div class="ranger-wrap">
                                <input type="range" step="500000" min="0" max="20000000" value="{{ request()->budget_min }}" id="slider-1" oninput="slideOne()">
                            </div>
                            @else
                            <div class="ranger-wrap">
                                <input type="range" step="500000" min="0" max="20000000" value="1000000" id="slider-1" oninput="slideOne()">
                            </div>
                            @endif
                            @if (request()->budget_max)
                            <div class="ranger-wrap">
                                <input type="range" step="500000" min="0" max="20000000" value="{{ request()->budget_max }}" id="slider-2" oninput="slideTwo()">
                            </div>
                            @else
                            <div class="ranger-wrap">
                                <input type="range" step="500000" min="0" max="20000000" value="1000000" id="slider-2" oninput="slideTwo()">
                            </div>
                            @endif
                        </div>
                    </div>
           
                    <div class="wrap-duration">
                        <label for="">Duration</label>
                        <input type="checkbox" name="duration" id="duration"  hidden="true" value="{{ request()->input('duration') ? request()->input('duration') : 'none'}}">                               
                        <ul class="style-square" id="duration-filter-group" data-duration-request="{{ request()->input('duration') ? request()->input('duration') : 'none'}}">
                            <li>
                                <label><input type="checkbox" value="0-3"> 0 - 3 days</label>
                            </li>
                            <li>
                                <label><input type="checkbox" value="3-5"> 3 - 5 days</label>
                            </li>
                            <li>
                                <label><input type="checkbox" value="5-7"> 5 - 7 days</label>
                            </li>
                            <li>
                                <label><input type="checkbox" value="more"> over 1 week</label>
                            </li>
                        </ul>
                    </div>
                                       
                    <div class="type-tour">
                        <label for="">Type Of Tours</label>
                        <input type="checkbox" name="type_tour" id="type_tour" hidden="true" value="{{ request()->input('type_tour') ? request()->input('type_tour') : 'none'}}">
                        <ul class="style-square" id="type-filter-group" data-type-request="{{ request()->input('type_tour') ? request()->input('type_tour') : 'none'}}">
                            @foreach ($typeTours as $typeTour)
                                <li>
                                    <label><input type="checkbox"  value="{{ $typeTour->slug }}"> {{ $typeTour->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="btn-ft-submit" type="submit" >Apply Filter</button>
                    
                </form>
            </div>
        </div>

        <div class="row">
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
