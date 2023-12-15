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
                            <!-- Add a link or button if needed -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="purchaseTable" class="table custom-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>User</th>
                                        <th>Item Name</th>
                                        <th>Quantity Sold</th>
                                        <th>Price</th> <!-- New column for Price -->
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                        @if (!$sale->voided)
                                            <tr>
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
                                                <td>{{ $sale->quantity_sold }}</td>
                                                <td>{{ $sale->inventory->price * $sale->quantity_sold }}</td> <!-- Calculate the total price -->
                                                <td>{{ $sale->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('purchases.void', ['id' => $sale->id]) }}" class="btn btn-danger">Void</a>
                                                    @if (!$sale->completed)
                                                        <button class="btn btn-success completePurchaseBtn" data-sale-id="{{ $sale->id }}">Complete</button>
                                                    @else
                                                        <span class="badge badge-success">Completed</span>
                                                    @endif
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

    <!-- Your new script -->
    <!-- Your new script -->
    <!-- Your new script -->
<!-- Your new script -->
<script>
    $(document).ready(function () {
        // Add a listener to the document for the button click
        $(document).on('click', '.completePurchaseBtn', function () {
            var saleId = $(this).data('sale-id');
            var $tableRow = $(this).closest('tr'); // Get the parent table row

            $.ajax({
                url: '{{ route("purchases.complete") }}',
                method: 'POST',
                data: { saleId: saleId },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        // Optionally, you can also update the Sales Management view
                        // ...

                        // Hide the table row if the sale is completed successfully
                        $tableRow.hide();

                        // Optionally, you can provide a user-friendly message
                        alert('Purchase completed successfully');
                    } else {
                        alert('Error completing purchase');
                    }
                },
                error: function (error) {
                    console.error(error);
                    alert('Error completing purchase');
                }
            });
        });
    });
</script>




</body>

</html>
