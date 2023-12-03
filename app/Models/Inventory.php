<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Inventory.php

class Inventory extends Model
{
    protected $fillable = [
        'item_name',
        'previous_quantity',
        'quantity_change',
        'new_quantity',
        'change_date',
        'description',
        'quantity',
        'image',
        'category',
        'price',
    ];
    
}
