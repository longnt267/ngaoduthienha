<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use App\Models\Destination;
use App\Models\TypeTour;
use App\Models\Itinerary;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Album;
use App\Models\DateOfTour;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
class Tour extends Model
{
    use HasFactory;

    const TAKE_ALL = 0;
    const TAKE_LASTEST = 1;
    const TAKE_TRENDING = 2;

    protected $guarded = ['id'];

    // relationship
    public function destination() 
    {
        return $this->belongsTo(Destination::class);
    }

    public function type_tour() 
    {
        return $this->belongsTo(TypeTour::class);
    }

    public function itineraries()
    {
        return $this->hasMany(Itinerary::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function datesOfTour()
    {
        return $this->hasMany(DateOfTour::class);
    }

    // scope filter
    public function scopeTitle($query, $request)
    {
        if($request->title) {
            return $query->where('title', 'LIKE', '%'. $request->title .'%');
        }
    }

    public function scopeDestination($query, $request)
    {
        if($request->destination) {
            return $query->where('destination_id', $request->destination);
        }
    }
    
    public function scopeTypeTour($query, $request)
    {   
        if($request->type_tour) {
            $slugs = json_decode($request->type_tour, true);
            // case 1: request from list_tour page
            if(is_array($slugs)) {
                foreach($slugs as $key => $slug) {
                    $typeTour = new TypeTour();
                    $typeTour = $typeTour->getTypeTourBySlug($slug);
                    if($key == 0) {
                        $query->where('type_tour_id', $typeTour->id);
                    }
                    $query->orWhere('type_tour_id', $typeTour->id);
                }
                return $query;
            }
            // case 2: request from homapge
            return $query->where('type_tour_id', $request->type_tour);
        }
    }

    public function scopeDuration($query, $request)
    {
        if($request->duration) {
            $durations = json_decode($request->duration, true);
            // case 1: request from list_tour page
            if(is_array($durations)) {
                foreach ($durations as $key => $duration) {
                    if($duration == 'more') {
                        $key == 0 ? $query->where('duration', '>', 7) : $query->orWhere('duration', '>', 7);
                    }
                    else {
                        $array = explode('-', $duration);
                        $key == 0 ? $query->whereBetween('duration', [$array[0], $array[1]]) : $query->orWhereBetween('duration', [$array[0], $array[1]]); 
                    }           
                }
                return $query;
            }
            // case 2: request from homapge
            return $query->where('duration', $request->duration);
        }
    }

    public function scopePrice($query, $request)
    {
        if(isset($request->budget_min) && isset($request->budget_max)) {
            return $query->whereBetween('price', [$request->budget_min, $request->budget_max]);
        }
    }
    
    public function saveRecord($request, $id = 0) 
    {
        $path = 'public\upload';
        if($request->image) {
            // storage image
            $image = $request->image->store($path);
            $this->image = basename($image);
        }
        $this->image = $this->image;
        $request->slug = Str::slug($request->slug);
        $description = [
            'overview' => $request->overview,
            'included' => $request->included,
            'departure' => $request->departure
        ];
        if (!empty($request->possible_date)) { 
            $possible_date = $request->possible_date;
        }

        $description = json_encode($description);
        $request->request->add(['description' => $description]);
        $request = $request->except(['image', 'overview', 'included', 'departure', 'possible_date']) + ['image' => $this->image];

        if ($id == 0)  {
            $tour = $this->create($request);
        } else {
            $this->update($request);
        }

        $dateSave = [];
        if (!empty($possible_date)) {
            $dates = explode(', ',$possible_date);
            foreach ($dates as $date) {
                array_push($dateSave, [
                    'tour_id' => $id == 0 ? $tour->id : $id,
                    'possible_date' => $date,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ]);
            }
        }
        if (count($dateSave) > 0) {
            DateOfTour::insert($dateSave);
        }
    }

    public function getDataAjax($request)
    {
        $data = self::select('*')->latest();
        if($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    $this->customFilterDataTable($query, $request);
                })
                ->addColumn('image', function($data) {
                    $pathImage = asset('storage/upload/'.$data->image);
                    return "<img  class='tb-image' src='".$pathImage."' />";
                })
                ->editColumn('price', function($data) {
                    return '$ ' .$data->price;
                })
                ->addColumn('trending', function($data) {
                    $url = route('tour.status', ['id' => $data->id]);
                    return view('admin.elements.switch_trending', compact('data','url'));
                })
                ->addColumn('status', function($data) {
                    $url = route('tour.status', ['id' => $data->id]);
                    return view('admin.elements.switch', compact('data','url'));
                })
                ->addColumn('action', function($data) {
                    $id = $data->id;
                    return view('admin.elements.act_tour', ['id' => $id]);
                })
                ->addColumn('more', function($data) {
                    $id = $data->id;
                    return view('admin.elements.more_act', compact('id'));
                })
                ->rawColumns(['image', 'status'])
                ->make(true);
        }
    }

    public function customFilterDataTable($query, $request)
    {
        if(!empty($request->search)) {
            $query->where('title', 'like', "%$request->search%");
        }
        if(!empty($request->status)) {
            $query->where('status', $request->status);
        }
        if(!empty($request->destination)) {
            $query->where('destination_id', $request->destination);
        }
        if(!empty($request->typeTour)) {
            $query->where('type_tour_id', $request->typeTour);
        }
    }

    public function changeStatusAjax($request, $id) 
    {
        $tour = $this->findOrFail($id);
        if($request->ajax()) {
            if($request->status) {
                $tour->status = $request->status;
            }
            if($request->trending) {
                $tour->trending = $request->trending;
            }
            $tour->save();
        } 
    }

    public function getTourById($id) 
    {
        return $this->findOrFail($id);
    }

    public function getAllTours()
    {
        $tours =  $this->where('status', 1)->select('*');
        foreach($tours as $tour) {
            $tour->duration = $this->convertDuration($tour->duration);
        }
        return $tours;
    }

    public function getAllToursByDes($destination_id)
    {
        $tours =  $this->where('destination_id', $destination_id)->where('status', 1)->select('*');
        foreach($tours as $tour) {
            $tour->duration = $this->convertDuration($tour->duration);
        }
        return $tours;
    }

    public function convertDuration($duration)
    {
        if($duration == 1) {
            $duration = '1 day';
        }
        if($duration > 1) {
            $duration = $duration.' days - '.($duration-1).' night';
        }
        return $duration;
    }
 
    public function getTourBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getTourByDestination($destination_id, $tour_id)
    {
        return $this->where('id', '!=', $tour_id)->where('destination_id', $destination_id)->latest()->take(6)->get();
    }

    public function filter($request)
    {
        $tours = $this->query()
                ->where('status', 1)
                ->title($request)
                ->destination($request)
                ->duration($request)
                ->typetour($request)
                ->price($request);
        return $tours;      
    }

    public function getData($type)
    {
        switch($type) {
            case Tour::TAKE_TRENDING:
                return $this->where('status', 1)->where('trending', 1)->latest()->paginate(10);
            case Tour::TAKE_LASTEST:
                return $this->where('status', 1)->latest()->take(8)->paginate(10);
            default:
                return $this->where('status', 1)->latest()->paginate(10);        
        }
    }

    public function getDataFilter($request)
    {
        $tours = $this->filter($request)->latest()->paginate(10);
        return $tours;
    }

    public function getTotalTour() {
        return $this->where('status', 1)->count();
    }
 }
