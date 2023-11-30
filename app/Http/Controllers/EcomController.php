<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class EcomController extends Controller
{
    public function index()
    {
        $inventoryData = Inventory::all();
        return view('ecom.front.ecom-layout', compact('inventoryData'));
    }
}