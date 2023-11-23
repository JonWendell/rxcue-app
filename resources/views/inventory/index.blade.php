<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
</head>
<body>
    <h1>Inventory</h1>

    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Previous Quantity</th>
                <th>Quantity Change</th>
                <th>New Quantity</th>
                <th>Date</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
