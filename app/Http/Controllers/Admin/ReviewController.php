<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index($tourId)
    {
        return view('admin.review.list', compact('tourId'));
    }

    public function store(ReviewRequest $request, $tourId)
    {
        $this->review->saveRecord($request, $tourId);
        return $this->fetchData($tourId);
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
}
