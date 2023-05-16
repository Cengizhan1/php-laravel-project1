<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'description_short',
        'status',
        'release_date',
    ];

    protected $translatable = [
        'name',
        'description',
        'description_short',
    ];
    protected $casts=[
      'release_date' =>'date'
    ];
}
