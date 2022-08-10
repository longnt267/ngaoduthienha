@extends('layouts.app')

@section('title', 'Tour Detail')

@section('logo')
    <img src="{{ asset('assets/images/logo-2.png') }}" alt="">
@endsection

{{-- import css --}}
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/client/tour_detail/tour_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel//dist//assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/tour_detail/responsive.css') }}">
@endsection

{{-- main-content --}}
@section('content')
    {{-- <!-- content --> --}}
    <div class="container wrap-content width-default">
        <div class="row">
            <div class="bread-crumb">
                <a href="#" class="first-br">Home</a>
                <div class="next-br">
                    <img src="{{ asset('assets/images/Ellipse.png') }}" alt="">
                    <a href="#">Tours</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 content">
                <div class="ct-title">
                    {{ $tour->title }}
                </div>

                <div class="location">
                    <img src="{{ asset('assets/icons/outline/shape.png') }}" alt="">
                    <span>{{ $tour->destination->title }}</span>
                </div>

                <div class="wrap-rating">
                    <div class="ct-rating">
                        <img src="{{ asset('assets/icons/outline/star.png') }}" alt="">
                        <span>{{ $rating['avg'] }}</span>
                    </div>
                    <p>{{ $rating['all'] }} reviews</p>
                </div>

                <div class="tour-gallery">
                    @if (count($tour->albums) > 0)
                        <div id="parent-glr" class="owl-carousel owl-theme">
                            @foreach ($tour->albums as $album)
                                <div class="item glr-item">
                                    <img src="{{ asset('storage/upload/' . $album->image) }}" alt="">
                                    <img src="{{ asset('assets/icons/outline/tamgiac2.png') }}" alt=""
                                        class="flag">
                                </div>
                            @endforeach
                        </div>

                        <div id="child-glr" class="owl-carousel owl-theme">
                            @foreach ($tour->albums as $album)
                                <div class="item">
                                    <img src="{{ asset('storage/upload/' . $album->image) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="parent-glr" class="owl-carousel owl-theme">
                            <div class="item glr-item">
                                <img src="{{ asset('assets/images/update.png') }}" alt="">
                                <img src="{{ asset('assets/icons/outline/tamgiac2.png') }}" alt=""
                                    class="flag">
                            </div>
                        </div>

                        <div id="child-glr" class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="{{ asset('assets/images/update.png') }}" alt="">
                            </div>
                        </div>
                    @endif

                </div>

                <div class="main-content">
                    <div class="interactive">
                        <div class="btn-descript orange">Descriptions</div>
                        <div class="btn-addtional">Additional Info</div>
                        <div class="btn-review">Reviews</div>
                    </div>
                    <div class="ct-detail" id="description">
                        @if (empty($tour->description))
                            <strong class="d-flex mt-4">Updating...</strong>
                        @else
                            <div class="section">
                                <div class="sect-title">Overview</div>
                                <span>{!! $tour->description->overview !!}</span>
                            </div>
                            <div class="section" id="new-type">
                                <div class="sect-title">Whats Included</div>
                                {!! $tour->description->included !!}
                            </div>
                            <div class="section">
                                <div class="sect-title">Departure & Return</div>
                                {!! $tour->description->departure !!}
                            </div>
                        @endif

                        <div class="section">
                            <div class="sect-title">Tour Itinerary</div>
                            <div class="st-collapse">
                                @if (count($tour->itineraries) > 0)
                                    @foreach ($tour->itineraries as $itinerary)
                                        <div class="st-collapse-item">
                                            <div class="collap-toggle">
                                                <span>
                                                    {{ $itinerary->title }}
                                                </span>
                                                <img src="{{ asset('assets/icons/outline/arrow-bot.png') }}"
                                                    class="btn-arr">
                                            </div>
                                            <div class="collap-content display">
                                                @if (count($itinerary->itinerary_details) > 0)
                                                    @foreach ($itinerary->itinerary_details as $item)
                                                        <div class="collap-ct-part">
                                                            <div class="ct-location">
                                                                <img
                                                                    src="{{ asset('assets/icons/outline/location3.png') }}">
                                                                <span>{{ $item->title }}</span>
                                                            </div>
                                                            {!! $item->content !!}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <strong class="mt-5">Updating...</strong>
                                @endif
                            </div>
                        </div>

                        <div class="section">
                            <div class="sect-title">Maps</div>
                            @if (empty($tour->map))
                                <strong class="mt-5">Updating...</strong>
                            @else
                                <div id="map">
                                    {!! $tour->map !!}
                                </div>
                            @endif
                        </div>
                        <div class="section">
                            <div class="sect-title">360° Panoramic Images</div>
                            @if (empty($tour->image_360))
                                <strong class="mt-5">Updating...</strong>
                            @else
                                <div class="img-360">
                                    <iframe src="{{ $tour->image_360 }}"></iframe>
                                </div>
                            @endif
                        </div>
                        <div class="section">
                            <div class="sect-title">Videos</div>
                            @if (empty($tour->video))
                                <strong class="mt-5">Updating...</strong>
                            @else
                                <div class="img-360">
                                    {!! $tour->video !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="ct-detail display" id="addtional-info">
                        <div class="section">
                            @if (empty($tour->addtional_info))
                                <strong class="mt-5">Updating...</strong>
                            @else
                                {!! $tour->addtional_info !!}
                            @endif
                        </div>
                        <div class="section">
                            <div class="sect-title">FAQs</div>
                            @if (count($tour->faqs) > 0)
                                @foreach ($tour->faqs as $faq)
                                    @if ($faq->status == 1)
                                        <div class="st-collapse">
                                            <div class="st-collapse-item">
                                                <div class="collap-toggle">
                                                    <div class="tg-title-2">
                                                        <img src="{{ asset('assets/icons/outline/help-circle.png') }}"
                                                            alt="">
                                                        <span>
                                                            {{ $faq->question }}
                                                        </span>
                                                    </div>
                                                    <img src="{{ asset('assets/icons/outline/arrow-bot.png') }}"
                                                        class="btn-arr">
                                                </div>
                                                <div class="collap-content display">
                                                    <div class="collap-ct-part">
                                                        {!! $faq->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <strong class="mt-5">Updating...</strong>
                            @endif
                        </div>
                    </div>
                    <div class="ct-detail display" id="review">
                        <div class="section">
                            <div class="total-review">
                                <div class="wrap-all">
                                    <div class="all-review">
                                        <strong>{{ $rating['avg'] }}/5</strong>
                                        <div class="average-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p>Based on <i>{{ $rating['all'] }} reviews</i></p>
                                    </div>
                                    <div class="review-cross" data-rating-all="{{ $rating['all'] }}">
                                        <div class="rc-item">
                                            <p>5 <i class="fas fa-star"></i></p>
                                            <div class="crossbar">
                                                <span class="crossbar-under" id="crossbar-5"
                                                    data-rating="{{ $rating['five'] }}"></span>
                                            </div>
                                            <span>{{ $rating['five'] }} reviews</span>
                                        </div>
                                        <div class="rc-item">
                                            <p>4 <i class="fas fa-star"></i></p>
                                            <div class="crossbar">
                                                <span class="crossbar-under" id="crossbar-4"
                                                    data-rating="{{ $rating['four'] }}"></span>
                                            </div>
                                            <span>{{ $rating['four'] }} reviews</span>
                                        </div>
                                        <div class="rc-item">
                                            <p>3 <i class="fas fa-star"></i></p>
                                            <div class="crossbar">
                                                <span class="crossbar-under" id="crossbar-3"
                                                    data-rating="{{ $rating['three'] }}"></span>
                                            </div>
                                            <span>{{ $rating['three'] }} reviews</span>
                                        </div>
                                        <div class="rc-item">
                                            <p>2 <i class="fas fa-star"></i></p>
                                            <div class="crossbar">
                                                <span class="crossbar-under" id="crossbar-2"
                                                    data-rating="{{ $rating['two'] }}"></span>
                                            </div>
                                            <span>{{ $rating['two'] }} reviews</span>
                                        </div>
                                        <div class="rc-item">
                                            <p>1 <i class="fas fa-star"></i></p>
                                            <div class="crossbar">
                                                <span class="crossbar-under" id="crossbar-1"
                                                    data-rating="{{ $rating['one'] }}"></span>
                                            </div>
                                            <span>{{ $rating['one'] }} reviews</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <div class="wrap-comment" data-base-url="{{ route('review.fetch', $tour->id) }}">
                                @include('components.review', ['reviews' => $reviews->getAllReviews($tour->id)])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 checkout">
                <div class="chkout-top">
                    <p>from $ <span>{{ $tour->price }}</span></p>
                </div>
                <div class="chkout-bot">
                    <div class="ckhout-bot-info">
                        <div class="duration">
                            <span>Duration:</span><br>
                            <strong>{{ $tour->convertDuration($tour->duration) }}</strong>
                        </div>
                        <div class="tour-type">
                            <span>Tour type:</span><br>
                            <strong>{{ $tour->type_tour->title }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="mr-5">The remaining amount:</span>
                        <strong class="max_people mr-2"></strong>
                        <span>people</span>
                    </div>
                    <form action="javascript:void(0)" id="booking-form" data-url="{{ route('booking.session') }}" data-url_check_max="{{ route('booking.checkMax') }}"
                        data-redirect="{{ route('checkout') }}">
                        <div class="wrap-input">
                            <img src="{{ asset('assets/icons/outline/date.png') }}" alt="">
                            <input type="text" name="departure_date" id="start-date">
                            <span style="margin: 0 20px 0 20px;">-</span>
                            <input type="text" id="end-date" disabled>
                            <input hidden id="dates_json" value="{{ $datesJson }}">
                        </div>
                        <div class="wrap-input">
                            <img src="{{ asset('assets/icons/outline/dual.png') }}" alt="">
                            <input type="number" name="number_people" id="number_people" data-price="{{ $tour->price }}"
                                min="1" value="1">
                            <input type="number" id="max_people" hidden>
                        </div>
                        <div class="total">
                            <span>Total</span>
                            <strong>$<span id="total">{{ $tour->price }}</span></strong>
                            <input type="text" class="d-none" name="total_price" id="total_price">
                        </div>
                        <input type="text" name="duration" id="duration" class="d-none"
                            value="{{ $tour->convertDuration($tour->duration) }}">
                        <input type="number" id="duration_number" class="d-none" value="{{ $tour->duration }}">
                        <input type="text" name="tour_id" class="d-none" id="tour_id" value="{{ $tour->id }}">
                        <input type="text" name="price" class="d-none" id="price" value="{{ $tour->price }}">
                        <input type="text" name="type_tour" class="d-none" id="type_tour"
                            value="{{ $tour->type_tour->title }}">
                        <input type="text" name="destination" class="d-none" id="destination"
                            value="{{ $tour->destination->title }}">
                        <input type="submit" id="btn-submit" value="Book now">
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- related tour --}}
    <div class="container wrap-related-tour width-default">
        <div class="row">
            <div class="rl-tour-title">Related tours</div>
            <div class="related-tour">
                @foreach ($toursRelateds as $tourRelated)
                    <div class="wrap-item">
                        <div class="part-top">
                            <img src="{{ asset('storage/upload/' . $tourRelated->image) }}" alt="">
                            <img src="{{ asset('assets/icons/outline/tamgiac.png') }}" alt="" class="flag">
                            <div class="rating">
                                <img src="{{ asset('assets/icons/outline/star.png') }}" alt="">
                                <span>{{ $reviews->getInfoRating($tourRelated->id)['avg'] }}</span>
                            </div>
                        </div>
                        <div class="part-bot">
                            <div class="location">
                                <img src="{{ asset('assets/icons/outline/shape.png') }}" alt="">
                                <span>{{ $tourRelated->destination->title }}</span>
                            </div>
                            <div class="title">
                                <a href="#">{{ $tourRelated->title }}</a>
                            </div>
                            <div class="sl2-item-info">
                                <div class="sl2-if-time">
                                    <img src="{{ asset('assets/icons/outline/time.png') }}" alt="">
                                    <span>{{ $tourRelated->convertDuration($tourRelated->duration) }}</span>
                                </div>
                                <div class="sl2-if-cost">from
                                    <strong>$ {{ $tourRelated->price }}</strong></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- import js --}}
@section('script')
    <script src="{{ asset('vendor/jquery.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/client/tour_detail.js') }}"></script>
    <script src="{{ asset('js/client/review.js') }}"></script>
@endsection
