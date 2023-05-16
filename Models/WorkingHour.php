<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WorkingHour extends Model
{
    use HasFactory;
    use HasTranslations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supervisor_id',
        'day',
        'start_at',
        'end_at',
        'launch_hour_start_at',
        'launch_hour_end_at',
    ];

    protected $casts = [
        'start_at'=>'datetime',
        'end_at'=>'datetime',
        'launch_hour_start_at'=>'datetime',
        'launch_hour_end_at'=>'datetime',
    ];


    protected $translatable = [];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }
}
