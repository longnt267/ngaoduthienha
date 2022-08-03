<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;
use Yajra\Datatables\Datatables;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'question',
        'answer',
        'status'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getDataAjax($request, $id)
    {  
        $data = $this->where('tour_id', $id)->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if(!empty($request->search)) {
                    $query->where('question', 'like', "%$request->search%");
                }
                if(!empty($request->status)) {
                    $query->where('status', $request->status);
                }
            })
            ->addColumn('status', function($data) {
                $url = route('faq.status', ['id' => $data->id]);
                return view('admin.elements.switch', compact('data','url'));
            })
            ->addColumn('action', function($data) {
                $id = $data->id;
                $tourId = $data->tour_id;
                return view('admin.elements.act_faq', compact('id','tourId'));
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function saveRecord($request, $tourId, $id = 0)
    {
        $request->request->add(['tour_id' => $tourId]);
        $request = $request->except(['id']);
        $id == 0 ? $this->create($request) : $this->update($request);
    }

    public function getFaqById($id)
    {
        return $this->findOrFail($id);
    }

    public function changeStatusAjax($request)
    {
        if($request->ajax()) {
            $this->status = $request->status;
            $this->save();
        } 
    }

}
