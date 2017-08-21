<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{

    protected $fillable = [
        'last_name', 'first_name', 'email', 'password',
    ];
}
