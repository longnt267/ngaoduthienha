<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Models\DateOfTour;
use App\Models\TypeTour;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $tour;
    protected $typeTour;
    protected $destination;
    protected $dateOfTour;

    public function __construct(Tour $tour, Destination $destination, TypeTour $typeTour, DateOfTour $dateOfTour) 
    {
        $this->tour = $tour;
        $this->dateOfTour = $dateOfTour;
        $this->destination = $destination->getAllDestinations();
        $this->typeTour = $typeTour->getAllTypeTours();
    }

    public function index()
    {
        return view('admin.tour.list', ['destination' => $this->destination, 'typeTour' => $this->typeTour]);
    }

    public function getData(Request $request) 
    {
        return $this->tour->getDataAjax($request);
    }

    public function create() 
    {
        return view('admin.tour.create', ['destination' => $this->destination, 'typeTour' => $this->typeTour]);
    }

    public function store(TourRequest $request)
    {
        try {
            $this->tour->saveRecord($request);
            if($request->submit == 'submit') {
                return back()->with('message', 'Tour added successfully'); 
            }
            return redirect()->route('tour.index')->with('message', 'Tour added successfully');      
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->with('error', 'Tour added failed');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $this->tour->changeStatusAjax($request, $id); 
    }

    public function edit($id) 
    {
        $data = $this->tour->getTourById($id);
        $data->description = json_decode($data->description);
        $datesJson = $this->dateOfTour->getArrayDates($id);
        return view('admin.tour.edit', ['destination' => $this->destination, 'typeTour' => $this->typeTour, 'data' => $data, 'datesJson' => $datesJson]);
    }

    public function update(TourRequest $request, $id)
    {
        try {
            $tour = $this->tour->getTourById($id);
            $tour->saveRecord($request, $id);
            return redirect()->route('tour.index')->with('message', 'Tour updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('tour.edit', $id)->with('error', 'Tour updated failed');
        }
    }

    public function destroy($id)
    {
        $tour = $this->tour->getTourById($id);
        $tour->delete();
    }

    public function test()
    {
        // $tour = Tour::where('destination_id', 3)->get()->map(function(Tour $tour) {
        //     $tour->price = $tour->price . '-minh';
        //     return $tour;
        // });
        $tour = Tour::where('destination_id', 3)
                        ->get()
                        ->groupBy('duration');
        dd($tour);
    }
}
