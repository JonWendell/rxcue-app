<?php

// app/Http/Controllers/SalesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Inventory;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        $cart = session('cart', []);
    
        foreach ($cart as $productId => $item) {
            $inventory = Inventory::find($productId);
    
            if (!$inventory) {
                // Handle the case where the inventory is not found
                continue; // Move on to the next iteration
            }
    
            $soldQuantity = min($item['quantity'], $inventory->new_quantity);
    
            $inventory->new_quantity -= $soldQuantity;
            $inventory->save();
    
            // Assuming Sale model has a relationship with User and Inventory models
            $sale = Sales::create([
                'user_id' => Auth::id(), // Capture the user ID
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
        session(['purchaseSuccess' => 'Purchase successful']); // Set success message
    
        return view('ecom.front.cart');
    }

    public function showPurchases()
    {
        // Fetch all sales data with associated user and inventory information
        $sales = Sales::with(['user', 'inventory'])->get();

        return view('cashier.purchase', compact('sales'));
    }

    public function voidPurchase(Request $request, $id)
    {
        // Find the sale by ID
        $sale = Sales::find($id);

        if (!$sale) {
            // Handle the case where the sale is not found
            abort(404);
        }

        // Perform void operation here, for example, mark the sale as voided
        $sale->voided = true;
        $sale->save();

        // You can add additional logic based on your requirements

        return redirect()->route('purchases.show')->with('success', 'Purchase voided successfully');
    }
   
    
   
   
    
}
