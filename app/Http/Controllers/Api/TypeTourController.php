<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TypeTourCollection;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeTour;

class TypeTourController extends BaseController
{
    protected $typeTour;

    public function __construct(TypeTour $typeTour)
    {
        $this->typeTour = $typeTour;
    }

    public function index()
    {
        $typeTours = new TypeTourCollection($this->typeTour->getData());
        return $this->sendResponse($typeTours, __('api.type_tour.index_success'), 200);
    }
}
