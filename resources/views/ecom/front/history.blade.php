<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Purchase History</h2>
        <a href="{{ route('customer') }}" class="btn btn-primary mb-3">Back to Customer Page</a>

        @if($userSales->isEmpty())
            <p>No purchase history available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>UPC</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Branch</th>
                        <th>Type of Purchase</th>
                        <th>Branch Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userSales->where('voided', false) as $sale)
                        <tr>
                            <td>{{ $sale->inventory->item_name }}</td>
                            <td>{{ $sale->inventory->upc }}</td>
                            <td>{{ $sale->quantity_sold }}</td>
                            <td>{{ $sale->quantity_sold * $sale->inventory->price }}</td>
                            <td>
                                @if($sale->inventory->branch)
                                    {{ $sale->inventory->branch->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>Walk In</td> <!-- Assuming type_of_purchase is always "Walk In" -->
                            <td>
                                @if($sale->inventory->branch)
                                    {{ $sale->inventory->branch->location }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('cancel.order', $sale->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.btn-danger').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var confirmed = confirm('Are you sure you want to cancel this order?');

                if (confirmed) {
                    $.ajax({
                        type: 'post',
                        url: form.attr('action'),
                        data: {
                            _token: form.find('input[name="_token"]').val(),
                            _method: 'delete'
                        },
                        success: function (response) {
                            console.log('Cancel Order Success:', response);
                            form.closest('tr').remove();
                        },
                        error: function (error) {
                            console.log('Cancel Order Error:', error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
