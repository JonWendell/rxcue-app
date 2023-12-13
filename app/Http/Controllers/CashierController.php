<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Support\Facades\Session;
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

    public function complete($id)
    {
        // Find the sale by ID
        $sale = Sales::find($id);

        // Perform any logic for completing the purchase
        // For example, update a status or perform additional actions

        // Redirect to the salemanage.blade.php view in the cashier folder
        return redirect()->route('cashier.manageSales');
    }

    public function completePurchase($id)
    {
        $sale = Sales::findOrFail($id);

        // Update the sale as completed
        $sale->update(['completed' => true]);

        // Remove the sale from the user's purchase history
        if ($sale->user) {
            $userSales = $sale->user->sales()->where('completed', false)->get();
            $userSales->find($id)->delete();
        }

        return response()->json(['message' => 'Purchase completed successfully']);
    }
    public function manageSales()
    {
        // Get completed sales
        $completedSales = Sales::where('completed', true)->get();

        return view('cashier.completed_purchases', compact('completedSales'));
    }
}
