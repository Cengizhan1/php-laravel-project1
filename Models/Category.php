<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'description_short',
    ];

    protected $translatable = [
        'name',
        'description',
        'description_short',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }


}
