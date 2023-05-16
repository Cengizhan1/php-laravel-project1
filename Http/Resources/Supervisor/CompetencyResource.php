<?php

namespace App\Http\Resources\Supervisor;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetencyResource extends JsonResource
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
            'status'=>$this->status,
            'message'=>$this->message,
            'media'=>[
                'doc'=>$this->getFirstMediaUrl('doc', 'crop') ?: null,
            ]
        ];
    }
}
