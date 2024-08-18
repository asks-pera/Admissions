<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Applicant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard='user';

    protected $fillable = [
        'section',
        'name',
        'nic',
        'mobile',
        'branch',
        'email', 
        'password'
    ];

    protected $hidden=[
        'password',
        'remember_token'
    ];
}
