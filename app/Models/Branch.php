<?php

// app/Models/Branch.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'location', 'contact', 'status', 'user_id'];

    // Define the inverse relationship with the 'User' model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
