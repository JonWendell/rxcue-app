<?php

namespace App\Http\Controllers;
use App\Models\Inventory;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
    public function products()
    {
        // Retrieve data from your Product model or other source
        $inventoryData = Inventory::all(); // Replace with your actual model and query

        // Pass the data to the view
        return view('products', ['inventoryData' => $inventoryData]);
    }
}



