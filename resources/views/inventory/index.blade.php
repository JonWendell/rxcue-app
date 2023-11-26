@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="main-container">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventory</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f5f5f5;
            }
    
            h1 {
                color: #333;
            }
    
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }
    
            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            button {
                background-color: #4CAF50;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
    
            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>Inventory</h1>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Previous Quantity</th>
                    <th>Added/Removed</th>
                    <th>New Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->item_name }}</td>
                        <td>{{ $inventory->previous_quantity }}</td>
                        <td>{{ $inventory->quantity_change }}</td>
                        <td>{{ $inventory->new_quantity }}</td>
                        <td>{{ $inventory->change_date }}</td>
                        <td>
                            <button onclick="redirectToAddPage('{{ $inventory->id }}')">Add Quantity</button>
                        </td>
                    </tr>
    
                    <!-- Check if added quantities exist before iterating -->
                    @if($inventory->addedQuantities)
                        @foreach($inventory->addedQuantities as $addedQuantity)
                            <tr>
                                <td></td>
                                <td>{{ $addedQuantity->previous_quantity }}</td>
                                <td>{{ $addedQuantity->quantity_change }}</td>
                                <td>{{ $addedQuantity->new_quantity }}</td>
                                <td>{{ $addedQuantity->change_date }}</td>
                                <td></td> <!-- Empty column for consistency -->
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    
        <script>
            function redirectToAddPage(id) {
                // Redirect to the page where you can add a new quantity for a specific item
                window.location.href = "{{ url('inventory/add') }}/" + id;
            }
        </script>
    </body>
    </html>    
</div>
    
@endsection
