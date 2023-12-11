<?php
// app/Http/Controllers/SalesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Inventory;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\User;

class SalesController extends Controller
{
    public function purchase()
    {
        $cart = session('cart', []);

        foreach ($cart as $productId => $item) {
            $inventory = Inventory::find($productId);
            $soldQuantity = min($item['quantity'], $inventory->new_quantity);

            $inventory->new_quantity -= $soldQuantity;
            $inventory->save();

            Sales::create([
                'inventory_id' => $productId,
                'quantity_sold' => $soldQuantity,
            ]);

            Audit::create([
                'inventory_id' => $productId,
                'current_quantity' => $inventory->new_quantity,
                'quantity' => -$soldQuantity,
                'new_stock' => $inventory->new_quantity,
                'type' => 'purchase',
                'upc' => $inventory->upc,
            ]);
        }

        session(['cart' => []]);

        return response()->json(['success' => true, 'message' => 'Purchase successful']);
    }
    public function showPurchases()
    {
        // Fetch all sales data with associated user and inventory information
        $sales = Sales::with(['user', 'inventory'])->get();
    
        return view('cashier.purchase', compact('sales'));
    }
}

