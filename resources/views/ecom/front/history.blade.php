<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your meta tags, stylesheets, and other head elements here -->
</head>

<body>
    <div class="container">
        <h2>Purchase History</h2>

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
                        <!-- Add more columns as needed -->
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

    <!-- Add your scripts or other body content here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handling cancel order button clicks
            $('.btn-danger').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var saleId = form.find('input[name="_method"]').next().val();

                // Add confirmation dialog if needed
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
                            // Optional: You can update the UI to show success or handle it as needed
                            console.log('Cancel Order Success:', response);

                            // Remove the canceled item from the purchase history UI
                            form.closest('tr').remove();
                        },
                        error: function (error) {
                            // Optional: You can update the UI to show an error or handle it as needed
                            console.log('Cancel Order Error:', error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
