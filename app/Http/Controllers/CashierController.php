<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function show()
    {
        return view('cashier.cashier');
    }

    public function showInventory()
    {
        $inventoryItems = Inventory::selectRaw('
            item_name,
            previous_quantity,
            quantity_change,
            new_quantity,
            change_date,
            created_at,
            updated_at,
            image
        ')
            ->get()
            ->toArray();

        return view('cashier.cashier-inventory', compact('inventoryItems'));
    }
}
