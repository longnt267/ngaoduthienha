<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\Models\Tour;
use App\Libraries\Ultilities;

class Destination extends Model
{   
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug', 
        'image',
        'status'
    ];

    public function tours() 
    {
        return $this->hasMany(Tour::class);
    }

    // render data for datatable
    public function getDataAjax($request) 
    {
        $data = $this->select('*')->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if(!empty($request->search)) {
                    $query->where('title', 'like', "%$request->search%");
                }
                if(!empty($request->status)) {
                    $query->where('status', $request->status);
                }
            })
            ->addColumn('image', function($data) {
                $pathImage = asset('storage/upload/'.$data->image);
                return "<img  class='tb-image' src='".$pathImage."' />";
            })
            ->addColumn('status', function($data) {
                $url = route('destination.status', ['id' => $data->id]);
                return view('admin.elements.switch', compact('data','url'));
            })
            ->addColumn('action', function($data) {
                $id = $data->id;
                return view('admin.elements.act_des', ['id' => $id]);
            })
            ->rawColumns(['image', 'status'])
            ->make(true);    
    }

    public function saveRecord($request, $id = 0)
    {
        $path = 'public\upload';
        $request->slug = Str::slug($request->slug);
        $request->slug = Ultilities::clearXSS($request->slug);
        if($request->image) {
            // storage image
            $image = $request->image->store($path);
            $this->image = basename($image);
        }
        $this->image = $this->image;
        $requestData = $request->except('image') + ['image' => $this->image];
        $id == 0 ? $this->create($requestData) : $this->update($requestData);
    }

    public function deleteRecord($id)
    {
        $destination = $this->getDestinationById($id);   
        $destination->delete();
    }

    // take a record
    public function getDestinationById($id) 
    {
        return $this->findOrFail($id);
    }

    public function getDestinationBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getAllDestinations() 
    {
        return $this->all();
    }

    public function changeStatusAjax($request) 
    {
        if($request->ajax()) {
            $this->status = $request->status;
            $this->save();
        } 
    }

    public function getData()
    {
        return $this->latest()->paginate(10);
    }

    public function getTotalDestination() {
        return $this->where('status', 1)->count();
    }
}
