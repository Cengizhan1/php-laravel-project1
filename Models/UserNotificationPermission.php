<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class UserNotificationPermission extends Model
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
        'sms_notification',
        'email_notification',
        'app_notification',
    ];

    protected $translatable = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
