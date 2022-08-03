<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TourCollection extends ResourceCollection
{
   
    private $pagination;
 
    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage(),
            'path' => $resource->path()
        ];
 
        $resource = $resource->getCollection();
 
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'tours' => $this->collection,
            'paginate' => $this->pagination
        ];  
    }
}
