<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

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
        
        $inventory = new Inventory;
        $inventory->previous_quantity = $validatedData['previous_quantity'];
        $inventory->quantity_change = $validatedData['quantity_change'];
        $inventory->new_quantity = $validatedData['new_quantity'];
        $inventory->change_date = $validatedData['change_date'];

        // Save the record to the database
        $inventory->save();

        // Create a new inventory record
        Inventory::create($validatedData);

        // Redirect to the inventory index page
        return redirect()->route('inventory.index')->with('success', 'Inventory item added successfully!');
    }

    public function update(Request $request)
    {
        // Validate the form data for update
        $validatedData = $request->validate([
            'item_name' => 'required|string',
            'previous_quantity' => 'required|numeric',
            'quantity_change' => 'required|numeric',
            'new_quantity' => 'required|numeric',
            'change_date' => 'required|date',
        ]);

        // Find the inventory record based on item name
        $inventory = Inventory::where('item_name', $validatedData['item_name'])->first();

        // Update the inventory record
        $inventory->update($validatedData);

        // Redirect back to the inventory index page
        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully!');
    }
        public function showAddForm()
    {
        return view('inventory.add');
    }
    
    
}
