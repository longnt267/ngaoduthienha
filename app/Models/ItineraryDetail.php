<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use App\Models\Itinerary;

class ItineraryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_id',
        'title',
        'content'
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }

    public function getDataAjax($request, $id)
    {
        $data = self::where('itinerary_id', $id)->latest();
        return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if(!empty($request->search)) {
                        $query->where('title', 'like', "%$request->search%");
                    }
                })
                ->addColumn('action', function($data) {
                    $id = $data->id;
                    $itineraryId = $data->itinerary_id;
                    return view('admin.elements.act_iti_detail', compact('id', 'itineraryId'));
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function saveRecord($request, $itineraryId)
    {
        $this->itinerary_id = $itineraryId;
        $this->title = $request->title;
        $this->content = $request->content;
        $this->save();
    }

    public function takeRecord($id)
    {
        return self::findOrFail($id);
    }
}
