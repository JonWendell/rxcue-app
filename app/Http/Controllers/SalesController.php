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
use Illuminate\Support\Facades\Response;

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
                // Handle the case where the inventory is not found or doesn't belong to the user's branch
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
        
        // Fetch only sales records related to the user's branch and not completed
        $sales = Sales::with(['user', 'inventory'])
            ->whereHas('inventory', function ($query) use ($userBranchId) {
                $query->where('branch_id', $userBranchId);
            })
            ->where('completed', false)
            ->get();
    
        return view('cashier.purchase', compact('sales'));
    }
    
    public function voidPurchase(Request $request, $id)
    {
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Find the sale record by ID
            $sale = Sales::find($id);
    
            if (!$sale) {
                abort(404);
            }
    
            // Find the associated inventory record
            $inventory = Inventory::find($sale->inventory_id);
    
            // Rollback the inventory to its previous state
            $inventory->new_quantity += $sale->quantity_sold;
            $inventory->save();
    
            // Update the sale record as voided
            $sale->voided = true;
            $sale->save();
    
            // Create an audit record for the voided sale
            Audit::create([
                'inventory_id' => $inventory->id,
                'current_quantity' => $inventory->new_quantity,
                'quantity' => $sale->quantity_sold,
                'new_stock' => $inventory->new_quantity + $sale->quantity_sold,
                'type' => 'void',
                'upc' => $inventory->upc,
            ]);
    
            // Commit the transaction if all steps are successful
            DB::commit();
    
            return redirect()->route('purchases.show')->with('success', 'Purchase voided successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();
    
            // Handle the exception (e.g., log, display an error message)
            return redirect()->route('purchases.show')->with('error', 'Error occurred while voiding purchase');
        }
    }
    public function completePurchase(Request $request)
{
    try {
        // Get the sale ID from the request
        $saleId = $request->input('saleId');

        // Find the sale record by ID
        $sale = Sales::find($saleId);

        if (!$sale) {
            return response()->json(['error' => 'Sale not found'], 404);
        }

        // Check if the sale is already completed
        if ($sale->completed) {
            return response()->json(['error' => 'Sale already completed'], 400);
        }

        // Mark the sale as completed
        $sale->completed = true;
        $sale->save();

        // You can add logic here to update Sales Management directly
        // For example, you can fetch the updated sales information and pass it to the view
        $salesManagement = Sales::with(['inventory'])
            ->where('completed', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the updated data to be handled in the JavaScript success callback
        return response()->json(['success' => true, 'salesManagement' => $salesManagement]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error completing sale'], 500);
    }
}


public function viewSales()
{
    // Fetch sales information for display
    $salesManagement = Sales::with(['user', 'inventory'])->get();

    return view('cashier.sales_management', compact('salesManagement'));
}

    



 
}