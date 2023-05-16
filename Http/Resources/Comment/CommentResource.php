<?php

namespace App\Http\Resources\Comment;

use ObiPlus\ObiPlus\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'date'=>$this->date,
            'star'=>$this->star,
            'comment'=>$this->comment,
            // TODO resource
            'user'=>$this->user,
            'supervisor'=>$this->supervisor,
            'meet'=>$this->meet,
        ];
    }
}
