<?php

// app/Models/Inventory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'previous_quantity',
        'quantity_change',
        'new_quantity',
        'change_date',
        'image',
        'category',
        'price',
        'upc', // Add this line for the new field
    ];
    

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }
}

