@extends('layouts.app')

@section('title', 'NgaoDuVietNam')

@section('logo')
    <img src="{{ asset('assets/images/logo-3.png') }}" alt="">
@endsection

{{-- import css --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/homepage/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/homepage/responsive.css') }}">
@endsection

{{-- header-content --}}
@section('header-content')
    <div class="row">
        <div class="content-header width-default">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-7">
                    <p>Welcome to NgaoduVietnam</p>
                    <strong>Perfect place for your stories</strong>
                </div>
                <div class="col-12 col-sm-12 col-lg-5">
                    <form action="{{ route('home.search') }}" class="form-search">
                        
                        <div class="form-search-item">
                            <h4>{{ __('Khám phá vẻ đẹp Việt Nam') }}</h4>
                        </div>
                        <div class="form-search-item wrap-input">
                            <img src="{{ asset('assets/icons/outline/search.png') }}">
                            <input type="text" name="title" placeholder="Tên tour">
                        </div>
                        <div class="form-search-item wrap-input">
                            <img src="{{ asset('assets/icons/outline/shape.png') }}">
                            <select name="destination" class="select2">
                                @foreach ($destinations as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-search-item wrap-input">
                            <img src="{{ asset('assets/icons/outline/flag.png') }}">
                            <select name="type_tour" class="select2">
                                @foreach ($typeTours as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-search-item wrap-input">
                            <img src="{{ asset('assets/icons/outline/date.png') }}">
                            <input type="number" name="duration" placeholder="Số ngày đi" min="1">
                        </div>
                        <button class="form-search-item wrap-submit border" type="submit">
                            <img src="{{ asset('assets/icons/outline/search-2.png') }}">
                            <span>Tìm kiếm</span>
                        </button>
                    </form>
                </div>
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="wrap-features-1">
                        <div class="wrap-ft-1-top">
                            <img src="assets/images/Ellipse-13.png">
                            <span>{{ __("Nổi bật") }}</span>
                        </div>
                        <div class="wrap-ft-1-bot">
                            <span>200+ <p>tour</p></span>
                            <span>100+ <p>điểm đến</p></span>
                            <span>8+ <p>loại tour</p></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main-content --}}
@section('content')
    <div class="container wrap-content width-default">
        <div class="description">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="dcr-image">
                        <img src="assets/images/Rectangle-18.png" id="dcr-img-1">
                        <img src="assets/images/Rectangle-19.png" id="dcr-img-2">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="wrap-dcr-content">
                        <div class="dcr-title">
                            <p>Cùng với <span>NgaoduVietnam</span>, đắm chìm trong không gian hùng vĩ và những nét văn hóa đặc sắc</p>
                        </div>
                        <div class="dcr-content">
                            <img src="assets/icons/outline/water.png" alt="">
                            <div class="dst-ct-detail">
                                <div class="ct-detail-top">
                                    Tại đây có tất cả những gì bạn cần để có một chuyến đi vui vẻ, đáng nhớ cùng gia đình và bạn bè. Bạn có thể ngắm nhìn cảnh sắc khắp mọi nơi trên đất nước Việt Name
                                </div>
                                <br>
                                <div class="ct-detail-bottom">
                                    Làm việc với phong cách chuyên nghiệp, chúng tôi đảm bảo sẽ giúp bạn tìm được tour du lịch một cách nhanh chóng, thuận lợi. Đảm bảo bạn sẽ có trải nghiệm sử dụng dịch vụ một cách tốt nhất
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-type-1">
            <div class="slide-header">
                <div class="sl-hd-title">
                    Khám phá các địa điểm du lịch thú vị
                </div>
                <button>View all</button>
            </div>

            <div class="sl-content">
                <div class="owl-carousel owl-theme owl-loaded " id="slide-1">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($destinations as $destination)
                                @if($destination->status == 1)
                                    <div class="owl-item sl1-item">
                                        <a href="{{ route('tourByDes', $destination->id) }}">
                                            <img src="{{ asset('storage/upload/'.$destination->image) }}" alt="">
                                        </a>
                                        <a class="location" href="{{ route('tourByDes', $destination->id) }}">{{ $destination->title }}</a>
                                        <p class="experience">24 experience</p>
                                    </div>
                                @endif
                            @endforeach                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="slide-type-2">
            <div class="slide-header">
                <div class="sl-hd-title">
                    Những nơi nghỉ ngơi tuyệt vời nhất
                </div>
                <button>View all</button>
            </div>

            <div class="sl2-content">
                <div class="owl-carousel owl-theme owl-loaded sl-t2">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($tours->get() as $tour)
                                @if ($tour->trending == 1)
                                <div class="owl-item sl2-item">
                                    <div class="sl2-item-img">
                                        <a href="{{ route('tour_detail', $tour->slug) }}">
                                            <img src="{{ asset('storage/upload/'.$tour->image) }}" alt="">
                                        </a>
                                        <div class="rating">
                                            <img src="assets/icons/outline/star.png" alt="">
                                            <span>{{ $review->getInfoRating($tour->id)['avg'] }}</span>
                                        </div>
                                        <div class="flag">
                                            <img src="assets/icons/outline/tamgiac2.png" alt="">
                                        </div>
                                    </div>
                                    <div class="sl2-item-location">
                                        <img src="assets/icons/outline/shape.png" alt="">
                                        <span>{{ $tour->destination->title }}</span>
                                    </div>
                                    <div class="sl2-item-title">
                                        <a href="{{ route('tour_detail', $tour->slug) }}">{{ $tour->title }}</a>
                                    </div>
    
                                    <div class="sl2-item-info">
                                        <div class="sl2-if-time">
                                            <img src="assets/icons/outline/time.png" alt="">
                                            <span>{{ $tour->convertDuration($tour->duration) }}</span>
                                        </div>
                                        <div class="sl2-if-cost">from <strong>${{ $tour->price }}</strong></div>
                                    </div>
                                </div>
                                @endif
                            @endforeach     
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end slide 2 --> 

        <div class="slide-type-2">
            <div class="slide-header">
                <div class="sl-hd-title">
                    Tour du lịch hấp dẫn và những trải nghiệm thú vị
                </div>
                <button>View all</button>
            </div>

            <div class="sl2-content">
                <div class="owl-carousel owl-theme owl-loaded sl-t2">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($tours->latest()->take(10)->get() as $tour)
                            <div class="owl-item sl2-item">
                                <div class="sl2-item-img">
                                    <a href="{{ route('tour_detail', $tour->slug) }}">
                                        <img src="{{ asset('storage/upload/'.$tour->image) }}" alt="">
                                    </a>
                                    <div class="rating">
                                        <img src="assets/icons/outline/star.png" alt="">
                                        <span>{{ $review->getInfoRating($tour->id)['avg'] }}</span>
                                    </div>
                                    <div class="flag">
                                        <img src="assets/icons/outline/tamgiac.png" alt="">
                                    </div>
                                </div>
                                <div class="sl2-item-location">
                                    <img src="assets/icons/outline/shape.png" alt="">
                                    <span>{{ $tour->destination->title }}</span>
                                </div>
                                <div class="sl2-item-title">
                                    <a href="{{ route('tour_detail', $tour->slug) }}">{{ $tour->title }}</a>
                                </div>

                                <div class="sl2-item-info">
                                    <div class="sl2-if-time">
                                        <img src="assets/icons/outline/time.png" alt="">
                                        <span>{{ $tour->convertDuration($tour->duration) }}</span>
                                    </div>
                                    <div class="sl2-if-cost">from <strong>{{ number_format($tour->price, 0, '', ',') }} đ</strong></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end slide 2 -->

        <!-- send email form -->
        <div class="row send-mail">
            
                <div class="col-12 col-sm-12 col-lg-8">
                    <div class="se-ct">Leave us an email, <br>to get <span>the latest deals</span></div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <form action="" method="post">
                        <div class="se-ct-input">
                            <div class="st-ct-ip-text">
                                <img src="assets/icons/outline/email.png" alt="">
                                <input type="text" placeholder="example@gmail.com">
                            </div>
                            <input type="button" value="Send">
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
@endsection

{{-- import js --}}
@section('script')
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.js') }}"></script>
    <script src="{{ asset('vendor/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/client/index.js') }}"></script>
    <script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('xtreme/dist/js/pages/forms/select2/select2.init.js') }}"></script>
@endsection