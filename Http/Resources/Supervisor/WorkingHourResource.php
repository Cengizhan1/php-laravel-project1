<?php

namespace App\Http\Resources\Supervisor;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHourResource extends JsonResource
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
            'day'=>$this->day,
            'start_at'=>$this->start_at,
            'end_at'=>$this->end_at,
            'launch_hour_start_at'=>$this->launch_hour_start_at,
            'launch_hour_end_at'=>$this->launch_hour_end_at,
        ];
    }
}
