<?php

namespace App\Http\Resources\Supervisor;

use ObiPlus\ObiPlus\Http\Resources\Json\JsonResource;

class SupervisorResource extends JsonResource
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
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'phone' => $this->user->phone,
            'email' => $this->user->email,
            'registration_completed' => $this->user->registration_completed,
            'firebase_uid' => $this->user->firebase_uid,
            'birth_date'=>$this->user->birth_date,
        ];
    }
}
