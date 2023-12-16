<?php

// app/Models/Sales.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'inventory_id',
        'quantity_sold',
        'user_id',
        'voided',
        'completed',
        'price_at_sale', // Add this line
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    // Relationship with audits
    public function audits()
    {
        return $this->hasManyThrough(Audit::class, Inventory::class, 'id', 'inventory_id', 'inventory_id', 'id');
    }
  
}
