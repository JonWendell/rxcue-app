<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Inventory Management';
    
        // Get the search input from the request
        $search = $request->input('search');
    
        // Query the inventories based on the search input
        $query = Inventory::query();
    
        if (!empty($search)) {
            $query->where('item_name', 'like', '%' . $search . '%');
        }
    
        // Fetch the filtered inventories
        $inventories = $query->get();
    
        return view('inventory.index', compact('pageTitle', 'inventories', 'search'));
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
            'description' => 'nullable|string',
            'previous_quantity' => 'required|numeric',
            'quantity_change' => 'required|numeric',
            'new_quantity' => 'required|numeric',
            'change_date' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'nullable|string', // Add this line for the new field
            'price' => 'required|numeric', // Add this line for the new field
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validatedData['image'] = basename($imagePath);
        }

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
            'description' => 'nullable|string',
            'quantity' => 'required|numeric',
            'category' => 'nullable|in:fluid,solid,other', // Adjust if needed
            'price' => 'required|numeric',
        ]);

        // Find the inventory record based on item name
        $inventory = Inventory::where('item_name', $validatedData['item_name'])->first();

        // Update the inventory record
        $inventory->update($validatedData);

        // Redirect back to the inventory index page
        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully!');
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

        // Update the existing inventory item with the new quantity
        $originalInventory->update([
            'previous_quantity' => $originalInventory->new_quantity,
            'quantity_change' => $request->input('quantity'),
            'new_quantity' => $newQuantity,
            'change_date' => now(),
        ]);

        // Redirect back to the inventory page
        return redirect()->route('inventory.index')->with('success', 'Quantity updated successfully!');
    }
    
}
