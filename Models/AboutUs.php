<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
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
    ];

    protected $translatable = [
        'name',
        'description',
        'description_short',
    ];

    public function about_us_opinions(){
        return $this->belongsToMany(Opinion::class,'about_us_opinions','aboutUs_id','opinion_id');
    }
    public function about_us_videos(){
        return $this->belongsToMany(Video::class,'about_us_videos','aboutUs_id','video_id');
    }
}
