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

    public function saveRecord($request, $tourId)
    {
        $this->tour_id = $tourId;
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
            ->addColumn('created_at', function($data) {
                return date('H:i:s d-m-Y', strtotime($data->created_at));
            })
            ->rawColumns(['created_at'])
            ->make(true);
    }

    public function getAllReviews($tourId)
    {
        return $this->where('tour_id', $tourId)->latest()->paginate(5);
    }

    public function getInfoRating($tourId)
    {
        $query = $this->where('tour_id', $tourId);
        $allRating = $this->where('tour_id', $tourId)->count();
        $oneStarRatings = $this->where('tour_id', $tourId)->where('star', 1)->count();
        $twoStarRatings = $this->where('tour_id', $tourId)->where('star', 2)->count();
        $threeStarRatings = $this->where('tour_id', $tourId)->where('star', 3)->count();
        $fourStarRatings = $this->where('tour_id', $tourId)->where('star', 4)->count();
        $fiveStarRatings = $this->where('tour_id', $tourId)->where('star', 5)->count();
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
}
