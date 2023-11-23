<!DOCTYPE html>
<html>
<head>
    <title>Create Inventory</title>
</head>
<body>
    <h1>Create Inventory</h1>

    <form method="post" action="{{ route('inventory.store') }}">
        @csrf
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required><br>

        <label for="previous_quantity">Previous Quantity:</label>
        <input type="number" name="previous_quantity" required><br>

        <label for="quantity_change">Quantity Change:</label>
        <input type="number" name="quantity_change" required><br>

        <label for="new_quantity">New Quantity:</label>
        <input type="number" name="new_quantity" required><br>

        <label for="change_date">Date:</label>
        <input type="date" name="change_date" required><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
