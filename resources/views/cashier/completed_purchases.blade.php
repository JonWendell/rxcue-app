<!-- resources/views/cashier/completed_purchases.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (existing code) ... -->
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Completed Purchases</h4>
                            <!-- You can add a back button or other navigation here if needed -->
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="completedPurchaseTable" class="table custom-table">
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
                                                    {{ $completedSale->user->firstName }} {{ $completedSale->user->middleName }} {{ $completedSale->user->lastName }}<br>
                                                    {{ $completedSale->user->address }}<br>
                                                    Age: {{ $completedSale->user->age }}, Gender: {{ $completedSale->user->gender }}
                                                @else
                                                    User information not available
                                                @endif
                                            </td>
                                            <td>{{ $completedSale->inventory->item_name }}</td>
                                            <td>{{ $completedSale->inventory->upc }}</td>
                                            <td>{{ $completedSale->quantity_sold }}</td>
                                            <td>{{ $completedSale->created_at }}</td>
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

    <script>
        $(document).ready(function () {
            $('#completedPurchaseTable').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>
