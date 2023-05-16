<?php

namespace App\Http\Resources\Meet;

use App\Http\Resources\Supervisor\SupervisorResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetShowResource extends JsonResource
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
//            'category'=>$this->category,
            'start_at' => get_formatted_date($this->start_at),
            'end_at'=> get_formatted_date($this->end_at),
            'price'=>$this->price,
            'supervisor_approval'=>$this->supervisor_approval,
            'user_approval'=>$this->user_approval,
            'canceled_count'=>$this->canceled_count,
            'canceled_message'=>$this->canceled_message,
            'code'=>$this->code,
            'user'=>UserResource::make($this->user),
            'supervisor'=>SupervisorResource::make($this->supervisor),
        ];
    }
}
