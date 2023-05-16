<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Actions\Actionable;
use Laravel\Passport\HasApiTokens;
use ObiPlus\ObiPlus\Models\User as UserModel;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class User extends UserModel
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasFactory;
    use HasApiTokens;
    use Actionable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'phone',
        'gender',
        'email',
        'wallet_id',
        'firebase_uid',
        'registration_completed',
        'last_activated_at',
        'supervisor_active', // if true -> supervisor active else -> user active
        'email_verified_at',
        'firebase_device_token',
        'is_delete',
        'bank_name',
        'iban',
        'birth_date',
        'birth_date',
        'cardUserKey'
    ];
    protected $casts=[
        'last_activated_at'=>'timestamp',
        'email_verified_at'=>'timestamp',
        'birth_date'=>'datetime',
    ];

    protected $translatable = [];

    public function wallet()
    {
        return $this->morphOne(Wallet::class,'walletable');
    }
    public function supervisor(){
        return $this->belongsTo(Supervisor::class,'supervisor_id');
    }
    public function permission(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserNotificationPermission::class, 'user_id');
    }
    public function getActiveIdAttribute()
    {
        return $this->supervisor_active ? $this->supervisor_id : $this->id;
    }
    public function getActiveTypeAttribute(): string
    {
        return $this->supervisor_active ? 'App\Models\Supervisor' : 'App\Models\User';
    }

    /**
     * Find the customer instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('firebase_uid', $username)->first();
    }
    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
    public function meets()
    {
        return $this->HasMany(Meet::class);
    }

}
