<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItineraryRequest;
use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use App\Models\Tour;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    protected $itinerary;

    public function __construct(Itinerary $itinerary)
    {
        $this->itinerary = $itinerary;
    }

    public function index($tourId, Tour $tour) 
    {
        $nameTour = $tour->getTourById($tourId)->title;
        return view('admin.itinerary.list', compact('tourId', 'nameTour'));
    }

    public function getData(Request $request, $tourId) 
    {
        return $this->itinerary->getDataAjax($request, $tourId);
    }

    public function create($tourId) 
    {
        return view('admin.itinerary.create', compact('tourId'));
    }

    public function store(ItineraryRequest $request, $tourId)
    {
        try {
            $this->itinerary->saveRecord($request, $tourId);
            return response()->json('Data added successfully');
        } catch (\Exception $e) {
            return response()->json('Data added failed');
        }
    }

    public function edit($tourId, $id)
    {
        $itinerary = $this->itinerary->takeRecord($id);
        return response()->json($itinerary);
    }

    public function update(ItineraryRequest $request, $tourId, $id)
    {
        try {
            $itinerary = $this->itinerary->takeRecord($id);
            $itinerary->saveRecord($request, $tourId);
            return response()->json('Data updated successfully');
        } catch (\Exception $e) {
            return response()->json('Data updated failed');
        }
    }

    public function destroy($id)
    {
        $itinerary = $this->itinerary->takeRecord($id);
        $itinerary->delete();
    }

}
