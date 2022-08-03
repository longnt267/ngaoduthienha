@if (isset($albums))
    <div id="parent-glr" class="owl-carousel owl-theme">
        @foreach ($albums as $album)
            <div class="item glr-item">
                <img src="{{ asset('storage/upload/' . $album->image) }}" alt="">
                <img src="{{ asset('assets/icons/outline/tamgiac2.png') }}" alt="" class="flag">
            </div>
        @endforeach
    </div>

    <div id="child-glr" class="owl-carousel owl-theme">
        @foreach ($albums as $album)
            <div class="item">
                <img src="{{ asset('storage/upload/' . $album->image) }}" alt="">
            </div>
        @endforeach
    </div>
@else
    <div id="parent-glr" class="owl-carousel owl-theme">
        @foreach ($albums as $album)
            <div class="item glr-item">
                <img src="{{ asset('storage/upload/' . $album->image) }}" alt="">
                <img src="{{ asset('assets/icons/outline/tamgiac2.png') }}" alt="" class="flag">
            </div>
        @endforeach
    </div>

    <div id="child-glr" class="owl-carousel owl-theme">
        @foreach ($albums as $album)
            <div class="item">
                <img src="{{ asset('storage/upload/' . $album->image) }}" alt="">
            </div>
        @endforeach
    </div>
@endif
