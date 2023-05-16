<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_no',
        'balance',
        'result_type', // enum
        'date',
        'customer_type',//Morph
        'customer_id',//Morph
        'card_id',
        'token',
    ];

    protected $casts=[
        'date' =>'datetime'
    ];


}
