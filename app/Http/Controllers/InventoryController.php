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
    
    public function getAddQuantity($id)
    {
        // Fetch inventory item by ID and pass it to the view
        $inventory = Inventory::find($id);
        return view('inventory.add_quantity', compact('inventory'));
    }

    public function postAddQuantity(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|numeric',
        ]);
    
        // Find the original inventory item
        $originalInventory = Inventory::find($id);
    
        // Calculate the new quantity
        $newQuantity = $originalInventory->new_quantity + $request->input('quantity');
    
        // Ensure that the new quantity is non-negative
        $newQuantity = max(0, $newQuantity);
    
        // Create a new inventory record with the updated quantity
        $newInventory = new Inventory([
            'item_name' => $originalInventory->item_name,
            'previous_quantity' => $originalInventory->new_quantity,
            'quantity_change' => $request->input('quantity'),
            'new_quantity' => $newQuantity,
            'change_date' => now(),
        ]);
    
        // Save the new inventory record
        $newInventory->save();
    
        // Redirect back to the inventory page
        return redirect()->route('inventory.index')->with('success', 'Quantity updated successfully!');
    }
    
}
