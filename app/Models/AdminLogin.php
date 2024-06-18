<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminLogin extends Authenticatable
{
    use HasFactory,HasApiTokens;
    protected $guard = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'ip_address',
        'mac_address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
