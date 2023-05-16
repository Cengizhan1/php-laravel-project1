<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WalletTransaction extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'senderable_type',
        'senderable_id',
        'recipientable_type',
        'recipientable_id',
        'meet_id',
        'price',
        'transaction_result',
        'date',
        'message',
    ];
    protected $casts=[
        'date'=>'datetime'
    ];

    protected $translatable = [];

    public function senderable()
    {
        return $this->morphTo();
    }
    public function recipientable()
    {
        return $this->morphTo();
    }
    public function meet(){
        return $this->belongsTo(Meet::class,'meet_id');
    }
}
