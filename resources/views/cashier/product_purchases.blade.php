<!-- resources/views/cashier/product_purchases.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Purchases - {{ $itemName }}</title>
    <!-- Link to Bootstrap CSS from CDN for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .table-responsive {
            margin-bottom: 20px;
        }

        .back-button {
            margin-top: 20px;
        }

        /* Adjustments for better responsiveness */
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="h4 mb-4">Product Purchases - {{ $itemName }}</h2>

        @php
            $totalSales = 0;
        @endphp

        @foreach($sales->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
        }) as $date => $groupedSales)
            <div class="table-responsive">
                <h4 class="mb-3">{{ $date }}</h4>
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Quantity Sold</th>
                            <th>Price at Sale</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupedSales as $sale)
                            <tr>
                                <td>{{ $sale->quantity_sold }}</td>
                                <td>₱{{ $sale->price_at_sale }}</td>
                                <td>{{ $sale->created_at }}</td>
                            </tr>
                            @php
                                // Update total sales amount
                                $totalSales += $sale->price_at_sale;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <div class="mt-4">
            <strong>Total Sales Amount:</strong> ₱{{ $totalSales }}
        </div>

        <div class="back-button">
            <!-- Link the back button to /purchases/sales -->
            <a href="{{ url('/purchases/sales') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <!-- Link to Bootstrap JS from CDN for enhanced styling -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
