<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your meta tags, stylesheets, and other head elements here -->
</head>

<body>
    <div class="container">
        <h2>Purchase History</h2>

        @if($userSales->isEmpty())
            <p>No purchase history available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($userSales as $sale)
                        <tr>
                            <td>{{ $sale->inventory->item_name }}</td>
                            <td>{{ $sale->quantity_sold }}</td>
                            <td>{{ $sale->quantity_sold * $sale->inventory->price }}</td>
                            <!-- Add more columns as needed -->
                        </tr>
                        <td>
                            <a href="{{ route('cancel.order', $sale->id) }}" class="btn btn-danger">Cancel Order</a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Add your scripts or other body content here -->

</body>

</html>
