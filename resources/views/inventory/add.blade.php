<!-- resources/views/inventory/add.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Add Inventory Item</title>
</head>
<body>
    <h1>Add New Inventory Item</h1>

    <form action="{{ route('inventory.store') }}" method="post">
        @csrf
        <!-- Input field for Previous Quantity -->
        <label for="previous_quantity">Previous Quantity:</label>
        <input type="text" name="previous_quantity" required>
        
        <!-- Input field for Added/Remove -->
        <label for="quantity_change">Added/Remove:</label>
        <input type="text" name="quantity_change" required>

        <!-- Input field for New Quantity -->
        <label for="new_quantity">New Quantity:</label>
        <input type="text" name="new_quantity" required>

        <!-- Input field for Date -->
        <label for="change_date">Date:</label>
        <input type="date" name="change_date" required>

        <!-- Submit button -->
        <button type="submit">Save</button>
    </form>
</body>
</html>

