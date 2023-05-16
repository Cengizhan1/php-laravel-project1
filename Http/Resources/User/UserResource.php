<?php

namespace App\Http\Resources\User;

use ObiPlus\ObiPlus\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'registration_completed' => $this->registration_completed,
            'firebase_uid' => $this->firebase_uid,
            'birth_date'=>$this->birth_date,
            'media'=>[
                'avatar'=>$this->getFirstMediaUrl('avatar', 'crop') ?: null,
            ]
        ];
    }
}
