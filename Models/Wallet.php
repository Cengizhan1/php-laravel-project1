<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Wallet extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'walletable_type',
        'walletable_id',
        'balance',
    ];

    protected $translatable = [];

    public function walletable()
    {
        return $this->morphTo();
    }
}
