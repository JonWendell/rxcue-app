<!-- purchase.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>User Purchases</title>

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
                            <h4 class="card-title">User Purchases</h4>
                            <a href="{{ route('cashier.show') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="purchaseTable" class="table custom-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>User</th>
                                        <th>Item Name</th>
                                        <th>UPC</th>
                                        <th>Quantity Sold</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                        @if (!$sale->completed)
                                            <tr id="sale-row-{{ $sale->id }}">
                                                <td>
                                                    @if($sale->user)
                                                        {{ $sale->user->firstName }} {{ $sale->user->middleName }} {{ $sale->user->lastName }}<br>
                                                        {{ $sale->user->address }}<br>
                                                        Age: {{ $sale->user->age }}, Gender: {{ $sale->user->gender }}
                                                    @else
                                                        User information not available
                                                    @endif
                                                </td>
                                                <td>{{ $sale->inventory->item_name }}</td>
                                                <td>{{ $sale->inventory->upc }}</td>
                                                <td>{{ $sale->quantity_sold }}</td>
                                                <td>{{ $sale->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('purchases.void', ['id' => $sale->id]) }}" class="btn btn-danger">Void</a>
                                                    <button class="btn btn-success complete-purchase" data-sale-id="{{ $sale->id }}">Complete Purchase</button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#purchaseTable').DataTable({
                responsive: true
            });

            // Handle the complete purchase button click
            $('#purchaseTable').on('click', '.complete-purchase', function () {
                var button = $(this);
                var saleId = button.data('sale-id');

                // Make an AJAX request to complete the purchase
                $.ajax({
                    url: "{{ url('cashier/complete-purchase') }}/" + saleId,
                    type: 'GET',
                    success: function (response) {
                        // Display a success message
                        alert(response.message);

                        // Remove the entire table row
                        var row = $('#sale-row-' + saleId);
                        table.row(row).remove().draw();
                    },
                    error: function (error) {
                        console.log(error);
                        alert('Error completing the purchase');
                    }
                });
            });
        });
    </script>

</body>

</html>
