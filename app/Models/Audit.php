<?php

// app/Models/Audit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'current_quantity',
        'quantity',
        'new_stock',
        'type',
        
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
        public function sale()
    {
        return $this->belongsTo(Sales::class, 'inventory_id', 'inventory_id');
    }

 
    
}


