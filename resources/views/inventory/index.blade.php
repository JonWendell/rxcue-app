<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
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
            </tbody>
        </table>

        <!-- Add button to add new item -->
        <button onclick="redirectToAddPage()">Add Quantity</button>
    @endforeach

    <script>
        function redirectToAddPage() {
            // Redirect to the page where you can add a new quantity
            window.location.href = "{{ route('inventory.add') }}";
        }
    </script>
</body>
</html>
