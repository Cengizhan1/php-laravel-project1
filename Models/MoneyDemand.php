<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MoneyDemand extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'demanded_price',
        'demand_reason_id',
        'date',
        'requester_id',
        'requester_type',
        'message',
        'status'
    ];
    protected $casts=[
        'date'=>'datetime'
    ];

    protected $translatable = [];

    public function requestable()
    {
        return $this->morphTo('requestable','requester_type','requester_id');
    }

}
