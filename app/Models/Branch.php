<?php

// app/Models/Branch.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'location', 'contact', 'status'];
}
