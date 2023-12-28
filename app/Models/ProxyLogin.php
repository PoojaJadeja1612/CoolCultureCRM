<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProxyLogin extends Model
{
    use HasFactory;
    protected $fillable = ['proxy_id', 'user_id', 'expires_at'];
}