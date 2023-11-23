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
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    @foreach($inventories as $inventory)
        <h1>{{ $inventory->item_name }} Inventory</h1>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Previous Quantity</th>
                    <th>Added/Remove</th>
                    <th>New Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $inventory->item_name }}</td>
                    <td>{{ $inventory->previous_quantity }}</td>
                    <td>{{ $inventory->quantity_change }}</td>
                    <td>{{ $inventory->new_quantity }}</td>
                    <td>{{ $inventory->change_date }}</td>
                </tr>

                <!-- Check if added quantities exist before iterating -->
                @if($inventory->addedQuantities)
                    @foreach($inventory->addedQuantities as $addedQuantity)
                        <tr>
                            <td>{{ $inventory->item_name }}</td>
                            <td>{{ $addedQuantity->previous_quantity }}</td>
                            <td>{{ $addedQuantity->quantity_change }}</td>
                            <td>{{ $addedQuantity->new_quantity }}</td>
                            <td>{{ $addedQuantity->change_date }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <!-- Add button to add new item -->
        <button onclick="redirectToAddPage('{{ $inventory->id }}')">Add Quantity</button>
    @endforeach

    <script>
        function redirectToAddPage(id) {
            // Redirect to the page where you can add a new quantity for a specific item
            window.location.href = "{{ url('inventory/add') }}/" + id;
        }
    </script>
</body>
</html>
