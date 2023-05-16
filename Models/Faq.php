<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
    ];

    protected $translatable = [
        'question',
        'answer'
    ];

    public function faqCategory(){
        return $this->belongsTo(FaqCategory::class,'faq_category_id');
    }
}
