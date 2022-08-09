<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateOfTour extends Model
{
    use HasFactory;
    protected $table = 'dates_of_tour';
    protected $fillable = [
        'possible_date',
        'people',
        'tour_id'
    ];

    public function getArrayDates($id)
    {
        $dates = $this->where('tour_id', $id)->where('possible_date' , '>=', now())->pluck('possible_date')->toArray();
        $datesJson = json_encode($dates);
        return $datesJson;
    }
}
