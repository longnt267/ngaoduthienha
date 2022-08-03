<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\TypeTourResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'destination' => new DestinationResource($this->destination),
            'type_tour' => new TypeTourResource($this->type_tour),
            'duration' => $this->duration,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image,
            'addtional_info' => $this->addtional_info,
            'map' => $this->map,
            'image_360' => $this->image_360,
            'video' => $this->video,
            'status' => $this->status
        ];
    }
}
