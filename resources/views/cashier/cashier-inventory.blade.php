<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cashier Inventory</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <!-- Add your custom styles here -->
    <style>
        /* Add custom styles here */
        .custom-table {
            width: 100%;
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Cashier Inventory</h4>
                        <a href="{{ route('cashier.show') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="inventoryTable" class="table custom-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Change Date</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventoryItems as $item)
                                    <tr>
                                        <td>{{ $item['item_name'] ?? '' }}</td>
                                        <td>{{ $item['new_quantity'] ?? '' }}</td>
                                        <td>{{ $item['change_date'] ?? '' }}</td>
                                        <td>
                                            <img src="{{ asset('storage/images/' . $item['image']) }}"
                                                alt="{{ $item['item_name'] }}" style="max-width: 100px;">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- Add your additional scripts here -->
<script>
    $(document).ready(function () {
        $('#inventoryTable').DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>
