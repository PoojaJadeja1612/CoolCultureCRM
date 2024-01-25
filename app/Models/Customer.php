<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guard = 'customer';

    protected $fillable = [
        'companyId',
        'name',
        'email',
        'number',
        'password',
        'profileImage',
        'address1',
        'address2',
        'pincode',
        'city',
        'state',
        'contry',
        'createBy',
        'updateBy',
        'deleted_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
