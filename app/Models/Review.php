<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'star',
        'comment',
        'status'
    ];

    public function saveRecord($request, $booking)
    {
        $this->booking_id = $booking->id;
        $this->tour_id = $booking->tour_id;
        $this->star = $request->star;
        $this->comment = $request->comment;
        $this->status = 1;
        $this->save();
    }

    public function getDataAjax($request, $id)
    {
        $data = $this->where('tour_id', $id)->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if(!empty($request->status)) {
                    $query->where('status', $request->status);
                }
                if(!empty($request->star)) {
                    $query->where('star', $request->star);
                }
            })
            ->editColumn('star', function ($data) {
                return $data->star . ' <i class="mdi mdi-star"></i>' ;
            })
            ->addColumn('created_at', function($data) {
                return date('H:i:s d-m-Y', strtotime($data->created_at));
            })
            ->addColumn('status', function($data) use ($id) {
                $url = route('review.status', ['tour_id' => $id, 'id' => $data->id]);
                return view('admin.elements.switch', compact('data','url'));
            })
            ->rawColumns(['created_at', 'star'])
            ->make(true);
    }

    public function getAllReviews($tourId)
    {
        return $this->where('tour_id', $tourId)->latest()->paginate(5);
    }

    public function getInfoRating($tourId)
    {
        $query = $this->where('tour_id', $tourId);
        $allRating = $this->where('tour_id', $tourId)->where('status', 1)->count();
        $oneStarRatings = $this->where('tour_id', $tourId)->where('status', 1)->where('star', 1)->count();
        $twoStarRatings = $this->where('tour_id', $tourId)->where('status', 1)->where('star', 2)->count();
        $threeStarRatings = $this->where('tour_id', $tourId)->where('status', 1)->where('star', 3)->count();
        $fourStarRatings = $this->where('tour_id', $tourId)->where('status', 1)->where('star', 4)->count();
        $fiveStarRatings = $this->where('tour_id', $tourId)->where('status', 1)->where('star', 5)->count();
        $averageStar = 0;
        if($allRating > 0 ) {
            $averageStar = ($oneStarRatings * 1 + $twoStarRatings * 2 + $threeStarRatings * 3 + $fourStarRatings * 4 + $fiveStarRatings *5) / $allRating;
            $averageStar = number_format($averageStar, 1);
        }

        return [
           'one' => $oneStarRatings,
           'two' => $twoStarRatings,
           'three' => $threeStarRatings,
           'four' => $fourStarRatings,
           'five' => $fiveStarRatings,
           'all' =>$allRating,
           'avg' => $averageStar
        ];
    }

    public function changeStatusAjax($request, $id) 
    {
        $review = $this->findOrFail($id);
        if($request->ajax()) {
            if($request->status) {
                $review->status = $request->status;
            }
            $review->save();
        } 
    }
}
