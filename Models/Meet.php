<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Meet extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'supervisor_id',
        'category_id',
        'start_at',
        'end_at',
        'price',
        'status',
        'supervisor_approval',
        'canceled_by_type',
        'message',
        'canceled_by_id',
        'user_approval',
        'canceled_count',
        'canceled_message',
        'code',
    ];
    protected $casts=[
        'start_at'=>'datetime',
        'end_at'=>'datetime'
    ];

    protected $translatable = [];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function supervisor(){
        return $this->belongsTo(Supervisor::class,"supervisor_id");
    }
    public function meet(){
        return $this->belongsTo(Meet::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
}
