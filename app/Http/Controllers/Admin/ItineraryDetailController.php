<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItineraryDetailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItineraryDetail;
use App\Models\Itinerary;

class ItineraryDetailController extends Controller
{   
    protected $itineraryDetail;

    public function __construct(ItineraryDetail $itineraryDetail)
    {
        $this->itineraryDetail = $itineraryDetail;
    }

    public function index(Itinerary $itinerary, $itineraryId)
    {
        $tour = $itinerary->takeRecordTour($itineraryId);
        return view('admin.itinerary-detail.list', compact('itineraryId', 'tour'));
    }

    public function getData(Request $request, $itineraryId)
    {
        return $this->itineraryDetail->getDataAjax($request, $itineraryId);
    }

    public function create(Itinerary $itinerary, $itineraryId)
    {
        $tour = $itinerary->takeRecordTour($itineraryId);
        return view('admin.itinerary-detail.create', compact('itineraryId', 'tour'));
    }

    public function store(ItineraryDetailRequest $request, $itineraryId)
    {
        try {
            $this->itineraryDetail->saveRecord($request, $itineraryId);
            return response()->json('Data added successfully');
        } catch (\Exception $e) {
            return response()->json('Data added failed');
        }
    }

    public function edit($itineraryId, $id)
    {
        $itineraryDetail = $this->itineraryDetail->takeRecord($id);
        return response()->json($itineraryDetail);       
    }

    public function update(ItineraryDetailRequest $request, $itineraryId, $id)
    {
        try {
            $itineraryDetail = $this->itineraryDetail->takeRecord($id);
            $itineraryDetail->saveRecord($request, $itineraryId);
            return response()->json('Data updated successfully');
        } catch (\Exception $e) {
            return response()->json('Data updated failed');
        }
    }

    public function destroy($id)
    {
        $itineraryDetail = $this->itineraryDetail->takeRecord($id);
        $itineraryDetail->delete();
    }
}
