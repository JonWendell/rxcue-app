<!-- resources/views/cashier/completed_purchases.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (existing code) ... -->
    <!-- Add Bootstrap CSS link for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Completed Purchases</h4>
                            <a href="{{ route('cashier.show') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="completedPurchaseTable" class="table custom-table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>User</th>
                                        <th>Item Name</th>
                                        <th>UPC</th>
                                        <th>Quantity Sold</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($completedSales as $completedSale)
                                        <tr>
                                            <td>
                                                @if($completedSale->user)
                                                    <dl>
                                                        <dt>Name:</dt>
                                                        <dd>{{ $completedSale->user->firstName }} {{ $completedSale->user->middleName }} {{ $completedSale->user->lastName }}</dd>
                                                        
                                                        <dt>Address:</dt>
                                                        <dd>{{ $completedSale->user->address }}</dd>
                                                        
                                                        <dt>Age:</dt>
                                                        <dd>{{ $completedSale->user->age }}</dd>
                                                        
                                                        <dt>Gender:</dt>
                                                        <dd>{{ $completedSale->user->gender }}</dd>
                                                    </dl>
                                                @else
                                                    User information not available
                                                @endif
                                            </td>
                                            <td>{{ $completedSale->inventory->item_name }}</td>
                                            <td>{{ $completedSale->inventory->upc }}</td>
                                            <td>{{ $completedSale->quantity_sold }}</td>
                                            <td>{{ $completedSale->created_at->format('M d, Y H:i:s') }}</td>
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

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- Add Bootstrap JS link for DataTables to work properly -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#completedPurchaseTable').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>
