<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Session;

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
    

    

    
    
}
