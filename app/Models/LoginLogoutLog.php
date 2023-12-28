<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLogoutLog extends Model
{
    use HasFactory;

    protected $table = 'login_logout_logs';

    protected $fillable = [
        'user_id',
        'action',
        'type',
    ];
}
