@if (!empty($reviews))
    @foreach ($reviews as $review)
        <div class="comment-item">
            <div class="cmt-item-top">
                <div class="img-personal">
                    <img src="{{ asset('assets/images/Rectangle-19.png') }}" alt="">
                </div>
                <div class="cmt-other">
                    <span>
                        @for ($i = 0; $i < $review->star; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for ($i = 0; $i < 5 - $review->star; $i++)
                            <i class="fas fa-star" style="color: #C4C4C4;"></i>
                        @endfor
                    </span>
                    <strong>The best experience ever!</strong>
                    <p>Nevermind - Sep 2020</p>
                </div>
            </div>
            <div class="cm-item-bot">
                <p>{{ $review->comment }}</p>
            </div>
        </div>
    @endforeach
    <div class="wrap-paginate">
        {{ $reviews->links() }}
    </div>
@endif
