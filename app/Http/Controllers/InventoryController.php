<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Audit;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Session;
use App\Models\Sales;
use App\Models\Inventories;
use App\Models\User;


class InventoryController extends Controller
{
    public function index(Request $request)
{
    $pageTitle = 'Inventory Management';

    // Get the search input from the request
    $search = $request->input('search');

    // Get the authenticated user's branch_id
    $branchId = auth()->user()->branch_id;

    // Query the inventories based on the user's branch
    $query = Inventory::where('branch_id', $branchId);

    // Additional filters based on the search input
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
        'category' => 'nullable|string',
        'price' => 'required|numeric',
        'upc' => 'nullable|string',
    ]);

    // Get the authenticated user's branch_id
    $branchId = auth()->user()->branch_id;

    // Add the branch_id to the validated data
    $validatedData['branch_id'] = $branchId;

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
            'category' => 'nullable|in:fluid,solid,other',
            'price' => 'required|numeric',
            'upc' => 'nullable|string', // Add this line for the new field
        ]);

        // Find the inventory record based on item name
        $inventory = Inventory::where('item_name', $validatedData['item_name'])->first();

        // Update the inventory record
        $inventory->update($validatedData);

        // Redirect back to the inventory index page
        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully!');
    }
    
    // ... existing methods ...

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

        // Record the audit
        Audit::create([
            'inventory_id' => $originalInventory->id,
            'current_quantity' => $originalInventory->new_quantity,
            'quantity' => $request->input('quantity'),
            'new_stock' => $newQuantity,
            'type' => 'add', // You can customize this value based on your needs
        ]);

        // Redirect back to the inventory page
        return redirect()->route('inventory.index')->with('success', 'Quantity updated successfully!');
    }

    public function auditHistory($id)
    {
        // Fetch inventory item by ID and pass it to the view
        $inventory = Inventory::find($id);

        // Load the 'inventory.audit_history' view and pass the $inventory data
        return view('inventory.audit_history', ['inventory' => $inventory]);
    }
        
}
