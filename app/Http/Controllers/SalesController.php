<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Inventory;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;

class SalesController extends Controller
{
    
    public function purchase(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            $cart = session('cart', []);

            foreach ($cart as $productId => $item) {
                $inventory = Inventory::where('id', $productId)
                    ->where('branch_id', Auth::user()->branch->id) // Ensure the inventory belongs to the user's branch
                    ->first();

                if (!$inventory) {
                    // Handle the case where the inventory is not found
                    continue; // Move on to the next iteration
                }

                $soldQuantity = min($item['quantity'], $inventory->new_quantity);

                // Calculate the price at sale based on the quantity sold
                $priceAtSale = $soldQuantity * $inventory->price;

                $inventory->new_quantity -= $soldQuantity;
                $inventory->save();

                // Assuming Sale model has a relationship with User and Inventory models
                $sale = Sales::create([
                    'user_id' => Auth::id(),
                    'inventory_id' => $productId,
                    'quantity_sold' => $soldQuantity,
                    'price_at_sale' => $priceAtSale, // Add this line
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

            // Commit the transaction if all steps are successful
            DB::commit();

            session(['cart' => []]);
            session(['purchaseSuccess' => 'Purchase successful']);

            return view('ecom.front.cart');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception (e.g., log, display an error message)

            return redirect()->back()->with('error', 'Error occurred during purchase');
        }
    }

    // ...


    
    
    public function showPurchases()
    {
        $userBranchId = Auth::user()->branch->id;
        // Fetch all sales data with associated user and inventory information
        $sales = Sales::with(['user', 'inventory'])->get();

        return view('cashier.purchase', compact('sales'));
    }

        public function voidPurchase(Request $request, $id)
    {
        $sale = Sales::find($id);

        if (!$sale) {
            abort(404);
        }

        $sale->voided = true;
        $sale->save();

        return redirect()->route('purchases.show')->with('success', 'Purchase voided successfully');
    }
        public function completePurchase(Request $request)
    {
        // Add logic to mark the purchase as completed in the database
        // You can customize this method based on your requirements
        // For example, you might want to update the status of completed purchases

        return response()->json(['success' => true]);
    }
        public function viewSales()
    {
        // Fetch sales information for display
        $sales = Sales::with(['user', 'inventory'])->get();

        return view('cashier.sales', compact('sales'));
    }


 
}