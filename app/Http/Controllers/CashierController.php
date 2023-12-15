<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use App\Models\Branch;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class CashierController extends Controller
{
    public function show()
    {
        return view('cashier.cashier');
    }

    public function showInventory()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'You must log in first.');
        }

        // Get the branch_id associated with the authenticated user
        $userBranchId = Auth::user()->branch->id;

        // Retrieve inventory items only for the user's branch
        $inventoryItems = Inventory::where('branch_id', $userBranchId)
            ->selectRaw('
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


    public function manageSales()
{
    // Ensure the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login.form')->with('error', 'You must log in first.');
    }

    // Get the branch_id associated with the authenticated user
    $userBranchId = Auth::user()->branch->id;

    // Get completed sales specific to the authenticated user's branch
    $completedSales = Sales::where('completed', true)
        ->whereHas('user', function ($query) use ($userBranchId) {
            $query->where('branch_id', $userBranchId);
        })
        ->get();

    return view('cashier.completed_purchases', compact('completedSales'));
}

}
