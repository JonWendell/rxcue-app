<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'item_name' => 'required|string',
            'previous_quantity' => 'required|numeric',
            'quantity_change' => 'required|numeric',
            'new_quantity' => 'required|numeric',
            'change_date' => 'required|date',
        ]);

        // Create a new inventory record
        Inventory::create($validatedData);

        // Redirect to the inventory index page
        return redirect()->route('inventory.index')->with('success', 'Inventory item added successfully!');
    }
}
