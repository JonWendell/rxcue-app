<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Session;
use App\Models\Sales;
use App\Models\Inventories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Audit;


class EcomController extends Controller
{
    public function index()
    {
        $inventoryData = Inventory::all();
        return view('ecom.front.ecom-layout', compact('inventoryData'));
    }

    public function showOrderLayout($productId)
    {
        $product = Inventory::find($productId);

        return view('ecom.front.order-layout', compact('product'));
    }
        public function showCart()
    {
        // You can add logic here to fetch cart data or perform any other actions
        // For now, let's just return the view
        return view('ecom.front.cart');
    }
    public function addToCart($productId)
    {
        $product = Inventory::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        $quantity = request('quantity', 1);
    
        $cart = Session::get('cart', []);
    
        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // If yes, update the quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // If no, add the product to the cart
            $cart[$productId] = [
                'name' => $product->item_name,
                'quantity' => 0, // Set initial quantity to 0
                'price' => $product->price,
                'totalPrice' => 0, // Set initial total price to 0
                'image' => $product->image,
            ];
        }
    
        // Update the total price
        $cart[$productId]['totalPrice'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
    
        // Update the quantity
        $cart[$productId]['quantity'] += $quantity;
    
        // Update the total price again after increasing the quantity
        $cart[$productId]['totalPrice'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
    
        Session::put('cart', $cart);
    
        return redirect()->back()->with('success', 'Item added to cart.');
    }
        public function removeFromCart($productId)
    {
        $cart = Session::get('cart', []);

        // Check if the product is in the cart
        if (isset($cart[$productId])) {
            // Remove the product from the cart
            unset($cart[$productId]);

            // Update the session with the modified cart
            Session::put('cart', $cart);

            return redirect()->back()->with('success', 'Item removed from cart.');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }


    public function home1()
    {
        return view('home1');
    }

    public function about2()
    {
        return view('about2');
    }
    public function product1()
    {
        // Retrieve data from your Product model or other source
        $inventoryData = Inventory::all(); // Replace with your actual model and query

        // Pass the data to the view
        return view('product1', ['inventoryData' => $inventoryData]);
    }
     
    public function showPurchaseHistory()
    {
        // Retrieve the authenticated user's purchase history excluding completed sales
        $userSales = Sales::where('user_id', Auth::id())
            ->where('completed', false) // Exclude completed sales
            ->with('inventory')
            ->get();
    
        return view('ecom.front.history', compact('userSales'));
    }
    public function cancelOrder(Sales $sale)
    {
        // Check if the authenticated user owns the order
        if (auth()->id() !== $sale->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to cancel this order.');
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find the associated inventory record
            $inventory = Inventory::find($sale->inventory_id);

            // Rollback the inventory to its previous state
            $inventory->new_quantity += $sale->quantity_sold;
            $inventory->save();

            // Update the sale record as voided
            $sale->voided = true;
            $sale->save();

            // Create an audit record for the canceled sale
            Audit::create([
                'inventory_id' => $inventory->id,
                'current_quantity' => $inventory->new_quantity,
                'quantity' => $sale->quantity_sold,
                'new_stock' => $inventory->new_quantity + $sale->quantity_sold,
                'type' => 'cancel',
                'upc' => $inventory->upc,
            ]);

            // Commit the transaction if all steps are successful
            DB::commit();

            return redirect()->back()->with('success', 'Order canceled successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception (e.g., log, display an error message)
            return redirect()->back()->with('error', 'Error occurred while canceling order.');
        }
    }

    
}
