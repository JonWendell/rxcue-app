<!-- resources/views/cashier/product_purchases.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Purchases - {{ $itemName }}</title>
    <!-- Add any necessary stylesheets or scripts here -->
</head>

<body>
    <div class="container mt-4">
        <h2 class="h4 mb-4">Product Purchases - {{ $itemName }}</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        
                        <th>Quantity Sold</th>
                        <th>Price at Sale</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            
                            <td>{{ $sale->quantity_sold }}</td>
                            <td>₱{{ $sale->price_at_sale }}</td>
                            <td>{{ $sale->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add any necessary scripts here -->
</body>

</html>
