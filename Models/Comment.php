<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Comment extends Model
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
        'meet_id',
        'date',
        'comment',
        'star',
    ];
    protected $casts=[
        'date'=>'datetime',
    ];

    protected $translatable = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function supervisor(){
        return $this->belongsTo(Supervisor::class);
    }
    public function meet(){
        return $this->belongsTo(Meet::class);
    }
}
