<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TourCollection;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends BaseController
{
    protected $tour;

    public function __construct(Tour $tour)
    {
        $this->tour = $tour;
    }

    public function index()
    {
        $tours = new TourCollection($this->tour->getData(Tour::TAKE_ALL));
    }

    public function filter(Request $request)
    {
        $tours = new TourCollection($this->tour->getDataFilter($request));
        return $this->sendResponse($tours, '', 200);
    }
}
