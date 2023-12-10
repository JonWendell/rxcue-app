@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Cart')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head elements here -->
    <title>Shopping Cart</title>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Shopping Cart</h2>

        @if(session('cart'))
            @foreach(session('cart') as $productId => $item)
                <div class="card mb-3">
                    <div class="row g-0">
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
                            <!-- Add a form for the purchase and remove actions -->
                            <form id="purchaseForm" action="{{ route('purchase') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary mb-2">Purchase</button>
                            </form>

                            <!-- Add a "Remove" button for each product -->
                            <form action="{{ route('remove-from-cart', $productId) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    <!-- Alert for Purchase Success -->
    <div id="purchaseSuccessAlert" class="alert alert-success" style="display:none;">
        <strong>Success!</strong> Your purchase was successful.
    </div>

    <!-- Add your footer scripts or links here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('form#purchaseForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("purchase") }}',
                    data: $('form#purchaseForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Display a success message as an alert
                        $('#purchaseSuccessAlert').fadeIn('slow');
                        
                        // Optional: You may want to hide the message after a few seconds
                        setTimeout(function() {
                            $('#purchaseSuccessAlert').fadeOut('slow');
                        }, 3000);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>
@endsection
