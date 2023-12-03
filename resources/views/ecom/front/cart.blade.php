<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head elements here -->
    <title>Shopping Cart</title>
</head>

<body>

    <div class="container">
        <h2>Shopping Cart</h2>

        @if(session('cart'))
            @foreach(session('cart') as $productId => $item)
                <div>
                    <h3>{{ $item['name'] }}</h3>
                    <p>Quantity: {{ $item['quantity'] }}</p>
                    <p>Price: ₱{{ $item['price'] }}</p>
                    <p>Total Price: ₱{{ $item['totalPrice'] }}</p> <!-- Display total price -->
                    <img src="{{ asset('storage/images/' . $item['image']) }}" alt="Product Image" class="img-fluid">
                    <!-- Add more details or styling as needed -->
                </div>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif

    </div>

    <!-- Add your footer scripts or links here -->

</body>

</html>
