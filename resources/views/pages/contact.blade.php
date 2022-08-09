@extends('layouts.app')

@section('title', 'Contact Us')

@section('logo')
    <img src="{{ asset('assets/images/logo-3.png') }}" alt="">
@endsection

{{-- import css --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/contact/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/contact/responsive.css') }}">
@endsection

{{-- header-content --}}
@section('header-content')
    <div class="contact width-default">
        <h1>Contact Us</h1>
    </div>
@endsection

{{-- main-content --}}
@section('content')
    <div class="container width-default">
        <div class="wrap-content">
            <div class="row">
                <div class="bread-crumb">
                    <a href="#" class="first-br">Home</a>
                    <div class="next-br">
                        <img src="assets/images/Ellipse.png" alt="">
                        <a href="#">Tours</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6 form-response">
                    <form action="javascript:void(0)" novalidate>
                        <h1>We'd love to hear from you</h1>
                        <p>Send us a message and we'll respond as soon as possible</p>
                        <input type="text" name="name" id="name" placeholder="Your name">
                        <span class="invalid-feedback d-inline" id="feedback-name" role="alert"></span>
                        <input type="text" name="email" id="email" placeholder="Your email">
                        <span class="invalid-feedback d-inline" id="feedback-email" role="alert"></span>
                        <input type="text" name="phone" id="phone" placeholder="Your phone">
                        <span class="invalid-feedback d-inline" id="feedback-phone" role="alert"></span>
                        <textarea name="message" cols="30" rows="10" id="message" placeholder="Message" style="resize: none;"></textarea>
                        <span class="invalid-feedback d-inline" id="feedback-message" role="alert"></span>
                        <div class="wrap-btn-submit">
                            <input type="submit" id="btn-submit" value="Send Message" onclick="storeContact('{{ route('contact.store') }}')">
                        </div>
                    </form>
                </div>
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="wrap-info">
                        <div class="info-layer1">
                            <img src="assets/images/Rectangle-36.png">
                        </div>
                        <div class="info-layer2">
                            <h4>Our Office</h4>
                            <div class="wrap-if2">
                                <img src="assets/icons/outline/home.png">
                                <span>
                                    <strong>Adress</strong>
                                    <p>27 Old Gloucester Street, London, WC1N 3AX</p>
                                </span>
                            </div>
                            <div class="wrap-if2">
                                <img src="assets/icons/outline/phone.png">
                                <span>
                                    <strong>Adress</strong>
                                    <p>27 Old Gloucester Street, London, WC1N 3AX</p>
                                </span>
                            </div>
                            <div class="wrap-if2">
                                <img src="assets/icons/outline/mail.png">
                                <span>
                                    <strong>Adress</strong>
                                    <p>27 Old Gloucester Street, London, WC1N 3AX</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8872445907064!2d105.7902081147986!3d20.997156494232623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acb0953a5a5d%3A0xd8392bbba95caa3d!2zNTYgUC4gVOG7kSBI4buvdSwgVHJ1bmcgVsSDbiwgTmFtIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1640753619252!5m2!1svi!2s"
                height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
@endsection

{{-- import js --}}
@section('script')
    <script src="{{ asset('vendor/jquery.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/client/contact.js') }}"></script>
@endsection
