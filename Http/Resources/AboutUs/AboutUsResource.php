<?php

namespace App\Http\Resources\AboutUs;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->description,
            'description_short'=>$this->description_short,
            'about_us_opinions'=>OpinionResource::collection($this->about_us_opinions),
            'about_us_videos'=>VideoResource::collection($this->about_us_videos),

        ];
    }
}
