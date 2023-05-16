<?php

namespace App\Http\Resources\Wallet;

use App\Enums\MoneyDemandStatusEnum;
use App\Enums\WalletTransactionEnum;
use App\Http\Resources\Meet\MeetIndexResource;
use App\Http\Resources\Meet\MeetShowResource;
use App\Http\Resources\Supervisor\SupervisorResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletTransactionResource extends JsonResource
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
            'user'=>UserResource::make($this->senderable),
            'supervisor' => SupervisorResource::make($this->recipientable),
            'meet'=> MeetIndexResource::make($this->meet),
            'price'=>$this->price,
            'transaction_result'=>WalletTransactionEnum::from($this->transaction_result)->label,
            'date'=>$this->date,
            'message'=>$this->message,
        ];
    }
}
