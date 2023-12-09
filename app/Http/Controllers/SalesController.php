<?php
// app/Http/Controllers/SalesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Inventory;
use App\Models\Audit;

class SalesController extends Controller
{
    // app/Http/Controllers/SalesController.php

    public function purchase()
    {
        // Retrieve the cart items
        $cart = session('cart', []);

        foreach ($cart as $productId => $item) {
            // Update inventory new_quantity
            $inventory = Inventory::find($productId);

            // Ensure that the sold quantity does not go below zero
            $soldQuantity = min($item['quantity'], $inventory->new_quantity);

            $inventory->new_quantity -= $soldQuantity;
            $inventory->save();

            // Record the sale
            Sales::create([
                'inventory_id' => $productId,
                'quantity_sold' => $soldQuantity,
            ]);

            // Record the purchase in audits
            Audit::create([
                'inventory_id' => $productId,
                'current_quantity' => $inventory->new_quantity,
                'quantity' => -$soldQuantity,
                'new_stock' => $inventory->new_quantity,
                'type' => 'purchase',
                'upc' => $inventory->upc,
            ]);
        }

        // Clear the cart after purchase
        session(['cart' => []]);

        // Return a response indicating success
        return response()->json(['success' => true, 'message' => 'Purchase successful']);
    }

}
