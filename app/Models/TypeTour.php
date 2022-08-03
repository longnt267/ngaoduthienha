<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\Libraries\Ultilities;

class TypeTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
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
            ->addColumn('status', function($data) {
                $url = route('type_tour.status', ['id' => $data->id]);
                return view('admin.elements.switch', compact('data','url'));
            })
            ->addColumn('action', function($data) {
                $id = $data->id;
                return view('admin.elements.act_type_tour', ['id' => $id]);
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function saveRecord($request, $id = 0) 
    {
        $request->slug = Str::slug($request->slug);
        $request->slug = Ultilities::clearXSS($request->slug);
        $requestData = $request->only(['title', 'slug', 'status']);
        $id == 0 ? $this->create($requestData) : $this->update($requestData);
    }

    public function deleteRecord($id)
    {
        $typeTour = $this->getTypeTourById($id);
        $typeTour->delete();
    }

    public function getTypeTourById($id) 
    {
        return $this->findOrFail($id);
    }

    public function getTypeTourBySlug($slug) 
    {
        return $this->where('slug', $slug)->first();
    }

    public function getAllTypeTours() 
    {
        return $this->all();
    }

    public function changeStatusAjax($request, $id) 
    {
        if($request->ajax()) {
            $typeTour = $this->getTypeTourById($id);
            $typeTour->status = $request->status;
            $typeTour->save();
        } 
    }

    public function getData()
    {
        return $this->latest()->paginate(10);
    }
}
