<!-- sales_audit.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Sales Audit Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p><strong>Item Name:</strong> {{ $sale->inventory->item_name }}</p>
            <a href="{{ route('purchases.sales') }}" class="btn btn-secondary">Back to Sales</a>
        </div>

        <!-- Display other audit details as needed -->
        <h4>Audit History</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Quantity Change</th>
                    <th>Current Quantity</th>
                    <th>New Stock</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalPrice = 0; ?>
                @foreach($sale->audits as $audit)
                    <tr>
                        <td>{{ $audit->created_at }}</td>
                        <td>{{ $audit->quantity }}</td>
                        <td>{{ $audit->current_quantity }}</td>
                        <td>{{ $audit->new_stock }}</td>
                        <td>{{ $audit->type }}</td>
                    </tr>
                    <?php 
                        // Use price from the inventory directly in the calculation
                        $totalPrice += $sale->inventory->price * $audit->quantity; 
                        // Debug output
                        echo "<tr><td colspan='5'>Debug: inventory price = " . $sale->inventory->price . ", quantity = " . $audit->quantity . "</td></tr>";
                    ?>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total Price at Sale:</strong> ₱{{ number_format(abs($totalPrice), 2) }}</p>
        
    </div>

    <!-- Bootstrap JS and other scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
