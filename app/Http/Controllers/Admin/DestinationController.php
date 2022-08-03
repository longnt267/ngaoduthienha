<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DestinationRequest;
use App\Models\Destination;


class DestinationController extends Controller
{   
    protected $destination;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    public function index() 
    {
        return view('admin.destination.list');
    }
    
    public function getData(Request $request) 
    {
        return $this->destination->getDataAjax($request);
    }

    public function create() 
    {
        return view('admin.destination.create');
    }

    public function store(DestinationRequest $request) 
    {
        try {
            $this->destination->saveRecord($request);
            if($request->submit == 'submit') {
               return back()->with('message', 'Destination added successfully'); 
            }
            return redirect()->route('destination.index')->with('message', 'Destination added successfully');          
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Destination added failed');
        }
    }

    public function edit($id) 
    {
        $data = $this->destination->getDestinationById($id);
        return view('admin.destination.edit',)->with('data', $data);
    }

    public function update(DestinationRequest $request, $id) 
    {
        try {
            $destination = $this->destination->getDestinationById($id);
            $destination->saveRecord($request, $id);
            return redirect()->route('destination.index')->with('message', 'Destination updated successfully'); 
        } catch (\Exception $e) {
            return back()->with('error', 'Destination updated failed');
        }
    }

    public function updateStatus(Request $request, $id) 
    {
        $destination = $this->destination->getDestinationById($id);
        $destination->changeStatusAjax($request);
    }

    public function destroy($id) 
    {
        $this->destination->deleteRecord($id);
    }
}
