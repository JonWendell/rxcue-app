@extends('back.layout.ecom-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Cart')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head elements here -->
    <title>Shopping Cart</title>

    <!-- Add your styles or links here -->

</head>

<body>
    <div class="container">
        <h2 class="mb-4">Shopping Cart</h2>

        @if(session('cart'))
            @foreach(session('cart') as $productId => $item)
                <div class="card mb-3">
                    <div class="row g-0">
                        <!-- Place the image within the column -->
                        <div class="col-md-3">
                            <img src="{{ asset('storage/images/' . $item['image']) }}" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['name'] }}</h5>
                                <p class="card-text">Quantity: {{ $item['quantity'] }}</p>
                                <p class="card-text">Price: ₱{{ $item['price'] }}</p>
                                <p class="card-text">Total Price: ₱{{ $item['totalPrice'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
                            <!-- Add a form for the purchase action -->
                            <button type="button" class="btn btn-primary mb-2 purchase-btn" data-product-id="{{ $productId }}" data-quantity="{{ $item['quantity'] }}">Purchase</button>

                            <!-- Add a "Remove" button for each product -->
                            <button type="button" class="btn btn-danger remove-btn" data-product-id="{{ $productId }}">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif

        <!-- Display the purchase success message if it exists -->
        <div class="purchase-success-message alert alert-success" style="display: none;">
            <strong>Success!</strong> Item purchased successfully.
        </div>
    </div>

    <!-- Add your footer scripts or links here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling purchase button clicks
            $('.purchase-btn').on('click', function() {
                var productId = $(this).data('product-id');
                var quantity = $(this).data('quantity');
                var purchaseButton = $(this); // Save a reference to the clicked button

                $.ajax({
                    type: 'post',
                    url: '{{ route('purchase') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        inventory_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Optional: You can update the UI to show success or handle it as needed
                        console.log('Purchase Success:', response);

                        // Show the success message
                        $('.purchase-success-message').fadeIn();

                        // Remove the purchased item from the cart UI
                        purchaseButton.closest('.card').remove();
                    },
                    error: function(error) {
                        // Optional: You can update the UI to show an error or handle it as needed
                        console.log('Purchase Error:', error);
                    }
                });
            });

            // Handling remove button clicks
            $('.remove-btn').on('click', function() {
                var productId = $(this).data('product-id');
                var removeButton = $(this); // Save a reference to the clicked button

                $.ajax({
                    type: 'post',
                    url: '{{ url('remove-from-cart') }}/' + productId,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'delete'
                    },
                    success: function(response) {
                        // Optional: You can update the UI to show success or handle it as needed
                        console.log('Remove Success:', response);

                        // Remove the removed item from the cart UI
                        removeButton.closest('.card').remove();
                    },
                    error: function(error) {
                        // Optional: You can update the UI to show an error or handle it as needed
                        console.log('Remove Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>

@endsection
