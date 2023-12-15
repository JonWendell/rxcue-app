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
    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">Sales Management</h2>
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">User Purchases</h4>
                <a href="{{ route('cashier.show') }}" class="btn btn-secondary">Back</a>
                <!-- Add a link or button if needed -->
            </div>

            <!-- Add this at the top of your Blade view, before the table -->
         

            <table class="table nowrap">
                <thead>
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
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item"
                                                                    ><i
                                                class="dw dw-eye"></i> View Details</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add your scripts or other body content here -->

    <!-- Bootstrap JS and other scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
