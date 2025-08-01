<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'admins';

    protected $fillable = [
        'username',
        'email',
    ];

    protected $hidden = [
        'password',
    ];
}
