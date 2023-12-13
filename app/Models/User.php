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
        'username', 'email', 'password', 'firstName', 'lastName', 'middleName', 'address', 'gender', 'age', 'role', 'branch_id', 'picture'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'user_id');
    }

    // Adjust the relationship to BelongsTo
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    
}

