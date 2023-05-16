<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use ObiPlus\ObiPlus\Models\Admin as AdminModel;

class Admin extends AdminModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'locale',
        'role_id',
        'password',
    ];
}
