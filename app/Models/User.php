<?php

// app/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
    public function getAuthIdentifierName()
    {
        return 'id'; // Change 'id' to your actual primary key column name
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

        public function getAuthPassword()
    {
        return $this->password;
    }
   
    public function sales()
    {
        return $this->hasMany(Sales::class, 'user_id');
    }
    
    
}
