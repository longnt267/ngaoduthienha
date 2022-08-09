<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Booking;
class ReviewController extends Controller
{
    protected $review;
    protected $booking;

    public function __construct(Review $review, Booking $booking)
    {
        $this->review = $review;
        $this->booking = $booking;
    }

    public function index($tourId)
    {
        return view('admin.review.list', compact('tourId'));
    }

    public function store(ReviewRequest $request, $booking_id)
    {
        $booking = $this->booking->findOrFail($booking_id);
        $review = $this->review->where('booking_id', $booking_id)->first();
        if (empty($review)) {
            $this->review->saveRecord($request, $booking);
            return redirect()->route('review_success');
        }
        return redirect()->route('review_error');
    }

    public function getData(Request $request, $tourId)
    {
        return $this->review->getDataAjax($request, $tourId);
    }

    public function fetchData($tourId)
    {
        $reviews = $this->review->getAllReviews($tourId);
        return view('components.review', compact('reviews'))->render();
    }

    public function viewReview($token) {
        $booking_id = json_decode(base64_decode($token), true)['booking_id'] ?? null;
        $email = json_decode(base64_decode($token), true)['email'] ?? null;
        if (empty($booking_id) || empty($email)) { 
            abort(404);
        }
        $booking = $this->booking->where('id', $booking_id)->where('email', $email);
        if (empty($booking)) { 
            abort(404);
        }
        $url = route('review.store', $booking_id);
        return view('pages.viewReview', compact('url'));
    }

    public function updateStatus(Request $request, $tour_id, $id)
    {
        $this->review->changeStatusAjax($request, $id); 
    }
}
