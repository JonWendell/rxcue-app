<?php

// app/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'middleName',
        'address',
        'gender',
        'age',
        'email',
        'role',
        'password',
    ];
}
