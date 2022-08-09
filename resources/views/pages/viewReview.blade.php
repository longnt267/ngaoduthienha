<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="{{ asset('css/client/review/viewReview.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}">
</head>

<body>
    <div class="thankyou">
        <div class="container">
            <strong class="thank">THANK YOU!</strong>
            <div class="type-comment">
                <img src="{{ asset('assets/images/user.png') }}" alt="">
                <form id="form-review" action="{{ $url }}" method="POST">
                    @csrf
                    <input type="text" name="star" id="input-star" value="4" hidden="true">
                    <textarea name="comment" id="input-comment" placeholder="Type something" style="resize: none;" cols="30"
                        rows="10"></textarea>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="wrap-rating-star">
                        <span class="rating-star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                        <input type="submit" id="review-submit" value="Send review">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/client/tour_detail.js') }}"></script>
</body>

</html>
