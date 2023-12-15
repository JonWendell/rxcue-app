<!-- resources/views/cashier/sales_management.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Sales Management</title>

    <!-- Add your meta tags, stylesheets, and other head elements here -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Sales Management</h2>

        @if($salesManagement->isEmpty())
            <p>No sales records available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity Sold</th>
                        <th>Price at Sale</th>
                        <th>Date</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesManagement as $sale)
                        <tr>
                            <td>{{ $sale->inventory->item_name }}</td>
                            <td>{{ $sale->quantity_sold }}</td>
                            <td>{{ $sale->price_at_sale }}</td>
                            <td>{{ $sale->created_at }}</td>
                            <!-- Add more columns as needed -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Add your scripts or other body content here -->

    <!-- Bootstrap JS and other scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
