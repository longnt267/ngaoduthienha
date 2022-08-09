<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check out</title>
    <link rel="stylesheet" href="{{ asset('css/client/checkout/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/checkout/responsive.css') }}">
</head>

<body>
    <div class="container">
        <form action="{{ route('booking.store') }}" method="POST" class="wrap-booking width-default">
            @csrf
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-8">
                    <div class="wrap-content">
                        <div class="content-title">Booking Submission</div>
                        <div class="section">
                            <div class="part-section">
                                <div class="sect-title">Traveler Details</div>
                                <p>Information we need to confirm your tour or activity</p>
                            </div>
                            <div class="part-section">
                                <div class="sect-title">Lead Traveler (Adult)</div>
                                <div class="info-user">
                                    <div class="wrap-input-1">
                                        <label>Firstname <span style="color:#FF7B42">*</span></label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control  @error('first_name') is-invalid @enderror" placeholder="First Name">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="wrap-input-1">
                                        <label>Lastname <span style="color:#FF7B42">*</span></label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control  @error('first_name') is-invalid @enderror">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="wrap-input-1">
                                        <label>Email <span style="color:#FF7B42">*</span></label>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="email@domain.com" class="form-control  @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="wrap-input-1">
                                        <label>Phone Number <span style="color:#FF7B42">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Your Phone" class="form-control  @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sect-title">Address</div>
                                <div class="address">
                                    <div class="wrap-input-1" style="width: 100%!important;">
                                        <label>Your Adress</label>
                                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Your Address">
                                    </div>
                                     <div class="info-user">
                                        <div class="wrap-input-1">
                                            <label>City</label>
                                            <input type="text" name="city" value="{{ old('city') }}" placeholder="Your City">
                                        </div>
                                        <div class="wrap-input-1">
                                            <label>State/Province/Region</label>
                                            <input type="text" name="region" value="{{ old('region') }}" placeholder="State/Province/Region">
                                        </div>
                                        <div class="wrap-input-1">
                                            <label>Zip Code/ Postal Code</label>
                                            <input type="text" name="zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code/ Postal Code">
                                        </div>
                                        <div class="wrap-input-1">
                                            <label>Country</label>
                                            <input type="text" name="country" value="{{ old('country') }}" placeholder="Your Country">
                                        </div>
                                    </div>
                                    <div class="special-require">
                                        <div class="wrap-input-2">
                                            <label>Special Requirement</label>
                                            <textarea name="note" placeholder="Special Requirement">{{ old('note') }}</textarea>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="checkout">
                        <div class="chkout-top">
                            <p>Discover interesting things in the romantic coastal city of Vungtau</p>
                            <div>
                                <img src="assets/icons/outline/shape.png" alt="">
                                <span>{{ $booking['destination'] }}</span>
                            </div>
                        </div>
                        <div class="chkout-bot">
                            <div class="ckhout-bot-info">
                                <div class="duration">
                                    <span>Duration:</span><br>
                                    <strong>{{ $booking['duration'] }}</strong>
                                </div>
                                <div class="tour-type">
                                    <span>Tour type:</span><br>
                                    <strong>{{ $booking['type_tour'] }}</strong>
                                </div>
                            </div>

                            <div class="wrap-input">
                                <img src="assets/icons/outline/date.png" alt="">
                                <input type="text" id="datepicker" value ="{{ $booking['departure_date'] }}" disabled>
                                <span style="margin-right: 10px;">-</span>
                                <input type="text" value="{{ $booking['end_date'] }}" disabled>
                            </div>
                            <div class="wrap-input">
                                <img src="assets/icons/outline/dual.png" alt="">
                                <input type="text" name="number_people" readonly value="{{ old('number_people', $booking['number_people']) }}">
                            </div>
                        </div>
                        <div class="total">
                            <span>Total</span>
                            <strong>$ {{ $booking['total_price'] }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-8">
                    <div class="wrap-content">
                        <div class="section">
                            <div class="part-section">
                                <div class="sect-title">Payment Menthod</div>
                                <p>Pay securely—we use SSL encryption to keep your data safe</p>
                            </div>
                            <div class="part-section">
                                
                                <div class="wrap-radio">
                                    <input type="radio" name="payment_method" value="2" checked>
                                    <label>Paypal</label>
                                    <img src="assets/images/logobank-2.png">
                                </div>
                                
                            </div>
                            <div class="part-section">
                                <ul>
                                    <li>You will be charged the total amount once your order is confirmed.</li>
                                    <li>If confirmation isn't received instantly, an authorization for the total amount
                                        will be held until your booking is confirmed.</li>
                                    <li>You can cancel for free up to 24 hours before the day of the experience, local
                                        time.
                                        By clicking ‘Pay with PayPal,’ you are acknowledging that you have read and are
                                        bound by Ojimah’s </li>
                                    <li>Customer Terms of Use, Privacy Policy, plus the tour operator’s rules &
                                        regulations (see the listing for more details).</li>
                                </ul>
                            </div>
                            <div class="part-section">
                                <div class="btn-submit">
                                    <input type="submit" value="Complete Booking">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
