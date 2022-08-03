<div class="wrap-menu width-default">
    <div class="row">
        <div class="col-lg-8 logo">
            <a href="{{ route('home') }}">
                @yield('logo')
            </a>
        </div>
        <div class="col-lg-4 menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('tour') }}">Tours</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="#">Login</a>
        </div>
        <div class="btn-menu">
            <i class="fal fa-bars"></i>
        </div>
    </div>
</div>
<div class="menu-responsive">
    <div class="logo">
        <img src="assets/images/logo-3.png">
        <i class="far fa-window-close btn-close"></i>
    </div>
    <div class="rs-menu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('tour') }}">Tours</a>
        <a href="{{ route('contact') }}">Contact</a>
        <a href="#">Login</a>
    </div>
</div>

