@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="main-container">
    <!DOCTYPE html>
    <html>
    
    <head>
        <title>Create Inventory</title>
    </head>
    
    <style>
        form {
            max-width: 500px;
            width: 200%; /* Adjusted width to 100% */
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
         
        h1 {
            
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
            width: 100%;
        }
    
        input {
            width: calc(100% - 16px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-align: left;
        }
    
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            width: 30%;
        }
    
        button:hover {
            background-color: #45a049;
        }
    </style>
    
                <form method="post" action="{{ route('inventory.store') }}">
                    @csrf
                    <h1>Create Inventory</h1>
                    <label for="item_name">Item Name</label>
                    <input type="text" name="item_name" required><br>
    
                    <label for="previous_quantity">Previous Quantity</label>
                    <input type="number" name="previous_quantity" required><br>
    
                    <label for="quantity_change">Quantity Change</label>
                    <input type="number" name="quantity_change" required><br>
    
                    <label for="new_quantity">New Quantity</label>
                    <input type="number" name="new_quantity" required><br>
    
                    <label for="change_date">Date</label>
                    <input type="date" name="change_date" required><br>
    
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </html>
    
@endsection
