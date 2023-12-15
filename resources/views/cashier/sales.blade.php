<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Sales Information</title>

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
                            <h4 class="card-title">Sales Information</h4>
                            <!-- Add any additional buttons or links if needed -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="salesTable" class="table custom-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>User</th>
                                        <th>Item Name</th>
                                        <th>Quantity Sold</th>
                                        <th>Cost</th>
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
                                                <td>{{ $sale->cost }}</td>
                                                <td>{{ $sale->date_sold }}</td>
                                                <td>
                                                    @if(!$sale->completed)
                                                        <a href="{{ route('purchases.void', ['id' => $sale->id]) }}" class="btn btn-danger">Void</a>
                                                        <a href="{{ route('purchases.complete', ['id' => $sale->id]) }}" class="btn btn-success">Complete</a>
                                                    @else
                                                        Sale Completed
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

    <!-- DataTables JS for the sales table -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#salesTable').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
