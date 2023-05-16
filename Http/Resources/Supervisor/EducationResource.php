<?php

namespace App\Http\Resources\Supervisor;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
            'id'=>$this->id,
            'start_at'=>$this->start_at,
            'end_at'=>$this->end_at,
            'school_name'=>$this->school_name,
            'department'=>$this->department,
        ];
    }
}
