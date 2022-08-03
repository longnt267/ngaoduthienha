<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use App\Models\ItineraryDetail;
use App\Models\Tour;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'title'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function itinerary_details()
    {
        return $this->hasMany(ItineraryDetail::class);
    }

    public function getDataAjax($request, $id)
    {
        $data = self::where('tour_id', $id)->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if(!empty($request->search)) {
                    $query->where('title', 'like', "%$request->search%");
                }
            })
            ->addColumn('action', function($data) {
                $id = $data->id;
                $tourId = $data->tour_id;
                return view('admin.elements.act_itinerary', compact('tourId', 'id'));
            })
            ->rawColumns(['action'])
            ->make(true); 
    }

    public function saveRecord($request, $id)
    {
        $this->tour_id = $id;
        $this->title = $request->title;
        $this->save();
    }

    public function takeRecord($id)
    {
        return self::findOrFail($id);
    }

    public function takeRecordTour($id)
    {
        $itinerary = self::findOrFail($id);
        return $itinerary->tour;
    }
}
