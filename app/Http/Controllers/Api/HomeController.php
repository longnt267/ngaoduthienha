<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\DestinationCollection;
use App\Http\Resources\TypeTourCollection;
use App\Http\Resources\TourCollection;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TypeTour;
use App\Models\Tour;

class HomeController extends BaseController
{
    protected $destination;
    protected $typeTour;
    protected $tour;

    public function __construct(Destination $destination, TypeTour $typeTour, Tour $tour)
    {
        $this->destination = $destination;
        $this->typeTour = $typeTour;
        $this->tour = $tour;
    }

    public function index()
    {
        $destinations = new DestinationCollection($this->destination->getData());
        $typeTours = new TypeTourCollection($this->typeTour->getData());
        $tourTrending = new TourCollection($this->tour->getData(Tour::TAKE_TRENDING));
        $tourLatest = new TourCollection($this->tour->getData(Tour::TAKE_LASTEST));

        $result = [
            'destinations' => $destinations,
            'type_tours' => $typeTours,
            'trending_tours' => $tourTrending,
            'latest_tours' => $tourLatest
        ];

        return $this->sendResponse($result, '', 200);
    }
}
