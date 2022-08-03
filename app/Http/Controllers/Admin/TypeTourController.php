<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeTourRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeTour;

class TypeTourController extends Controller
{
    protected $typeTour;

    public function __construct(TypeTour $typeTour)
    {
        $this->typeTour = $typeTour;
    }

    public function index() 
    {
        return view('admin.type-tour.list');
    }

    public function getData(Request $request) 
    {
        return $this->typeTour->getDataAjax($request);
    }

    public function create() 
    {
        return view('admin.type-tour.create');
    }

    public function store(TypeTourRequest $request) 
    {
        try {
            $this->typeTour->saveRecord($request);
            if($request->submit == 'submit') {
                return back()->with('message', 'Type of tour added successfully'); 
            }
            return redirect()->route('type_tour.index')->with('message', 'Type of tour added successfully');    
        } catch (\Exception $e) {
            return redirect()->route('type_tour.create')->withInput()->with('error', 'Type of tour added failed');
        }
    }

    public function edit($id) 
    {
        $data = $this->typeTour->getTypeTourById($id);
        return view('admin.type-tour.edit',)->with('data', $data);
    }

    public function update(TypeTourRequest $request, $id) 
    {
        try {
            $typeTour = $this->typeTour->getTypeTourById($id);
            $typeTour->saveRecord($request, $id);
            return redirect()->route('type_tour.index')->with('message', 'Type of tour updated successfully');         
        } catch (\Exception $e) {
            return redirect()->route('type_tour.edit', $id)->with('error', 'Type of tour updated failed');
        }
    }

    public function updateStatus(Request $request, $id) 
    {
        $this->typeTour->changeStatusAjax($request, $id);
    }

    public function destroy($id) 
    {
        return $this->typeTour->deleteRecord($id);
    }
}
