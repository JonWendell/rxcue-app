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
        'upc',
        'branch_id',
    ];
    
    

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }
    public function sales()
    {
        return $this->hasMany(Sales::class, 'inventory_id');
    }
}

