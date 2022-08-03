<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\DestinationCollection;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends BaseController
{
    protected $destination;
   

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    public function index()
    {
        $destinations = new DestinationCollection($this->destination->getData());
        return $this->sendResponse($destinations, __('api.destination.index_sucess'), 200);
    }

}
