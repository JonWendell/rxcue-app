<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'middleName',
        'Branches', // Change the field name to 'Branches'
        'gender',
        'age',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'user_id');
    }

    // Define the relationship with the 'Branch' model
    public function branch()
    {
        return $this->hasOne(Branch::class, 'user_id');
    }
}
