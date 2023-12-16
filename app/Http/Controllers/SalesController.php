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
                ->where('branch_id', Auth::user()->branch->id)
                ->first();

            if (!$inventory) {
                // Handle the case where the inventory is not found or doesn't belong to the user's branch
                continue;
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
                'price_at_sale' => $priceAtSale,
            ]);

            if ($sale->completed) {
                \Log::info('Sale completed - creating audit record');
                // Create an audit record for the completed sale
                Audit::create([
                    'inventory_id' => $productId,
                    'current_quantity' => $inventory->new_quantity,
                    'quantity' => -$soldQuantity,
                    'new_stock' => $inventory->new_quantity,
                    'type' => 'purchase',
                    'upc' => $inventory->upc,
                ]);
            }
        }

        // Commit the transaction if all steps are successful
        DB::commit();

        // Clear the cart after a successful purchase
        session()->forget('cart');

        session(['purchaseSuccess' => 'Purchase successful']);

        return view('ecom.front.cart');
    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception (e.g., log, display an error message)
        \Log::error('Error occurred during purchase: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error occurred during purchase');
    }
}
    
    
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

    // Fetch audit history for each inventory item
    $inventoryAuditHistory = [];
    foreach ($sales as $sale) {
        $inventoryId = $sale->inventory->id;
        \Log::info("Fetching audit history for inventory ID: $inventoryId");
        $auditHistory = Audit::where('inventory_id', $inventoryId)->get();
        $inventoryAuditHistory[$inventoryId] = $auditHistory;
    }

    return view('cashier.purchase', compact('sales', 'inventoryAuditHistory'));
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
    
            // Check if the sale is already voided or completed
            if ($sale->voided || $sale->completed) {
                return redirect()->route('purchases.show')->with('error', 'Sale is already voided or completed');
            }
    
            // Rollback the inventory to its previous state
            $inventory->new_quantity += $sale->quantity_sold;
            $inventory->save();
    
            // Update the sale record as voided
            $sale->voided = true;
    
            // Save the original price_at_sale for auditing
            $originalPriceAtSale = $sale->price_at_sale;
    
            // Subtract the voided quantity from the quantity_sold and adjust the total price
            $sale->quantity_sold = 0;
            $sale->price_at_sale = 0; // Set the total price to 0 for voided sales
    
            $sale->save();
    
            // Create an audit record for the voided sale
            Audit::create([
                'inventory_id' => $inventory->id,
                'current_quantity' => $inventory->new_quantity,
                'quantity' => -$sale->quantity_sold,
                'new_stock' => $inventory->new_quantity + $sale->quantity_sold,
                'type' => 'void',
                'upc' => $inventory->upc,
                'original_price_at_sale' => $originalPriceAtSale,
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
            if (!$sale->completed) {
                // Mark the sale as completed
                $sale->completed = true;
                $sale->save();
    
                \Log::info('Sale completed - creating audit record');
    
                // You can add logic here to update Sales Management directly
                // For example, you can fetch the updated sales information and pass it to the view
                $salesManagement = Sales::with(['inventory'])
                    ->where('completed', true)
                    ->orderBy('created_at', 'desc')
                    ->get();
    
                // Create an audit record for the completed sale
                Audit::create([
                    'inventory_id' => $sale->inventory_id,
                    'current_quantity' => $sale->inventory->new_quantity,
                    'quantity' => -$sale->quantity_sold,
                    'new_stock' => $sale->inventory->new_quantity,
                    'type' => 'purchase',
                    'upc' => $sale->inventory->upc,
                ]);
    
                // Return the updated data to be handled in the JavaScript success callback
                return response()->json(['success' => true, 'salesManagement' => $salesManagement]);
            } else {
                return response()->json(['error' => 'Sale already completed'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error completing sale'], 500);
        }
    }
    
    


        public function viewSales()
    {
        // Fetch only completed sales information for display
        $salesManagement = Sales::with(['user', 'inventory'])
            ->where('completed', true)
            ->get();

        return view('cashier.sales_management', compact('salesManagement'));
    }
     



 
}