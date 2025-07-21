<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $fillable = [
        'nama', 'username', 'password', 'email', 'level', 'foto', 'token', 'last_login_at', 'remember_token',
    ];

    protected $hidden = ['password'];
}
