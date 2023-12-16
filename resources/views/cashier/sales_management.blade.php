<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add necessary meta tags, stylesheets, and scripts here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Management</title>
    <!-- Link to Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="h4 mb-4">Sales Management</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">User Purchases</h4>
                    <a href="{{ route('cashier.show') }}" class="btn btn-secondary">Back</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Item Name</th>
                                <th>Total Quantity Sold</th>
                                <th>Total Price at Sale</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salesManagement->groupBy('inventory.item_name') as $itemName => $sales)
                            <tr>
                                <td class="table-plus">{{ $itemName }}</td>
                                <td>{{ $sales->sum('quantity_sold') }}</td>
                                <td>₱{{ $sales->sum('price_at_sale') }}</td>
                                <td>{{ $sales[0]->created_at }}</td>
                                <td>
                                    <!-- Add a button for each sale -->
                                    
                                        <i class="dw dw-eye"></i> View Audit
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS from CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
