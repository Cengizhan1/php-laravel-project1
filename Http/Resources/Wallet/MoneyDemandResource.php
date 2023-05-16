<?php

namespace App\Http\Resources\Wallet;

use App\Enums\MoneyDemandStatusEnum;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MoneyDemandResource extends JsonResource
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
            'demanded_price'=>$this->demanded_price,
            'demand_reason_id' => $this->demand_reason_id,
            'date'=> $this->date,
            'message'=>$this->message,
            'status'=>MoneyDemandStatusEnum::from($this->status)->label,
            'requester'=>UserResource::make($this->requestable),
        ];
    }
}
