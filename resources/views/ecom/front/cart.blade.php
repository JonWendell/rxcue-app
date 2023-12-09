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
                    
                    <!-- Add a "Remove" button for each product -->
                    <form action="{{ route('remove-from-cart', $productId) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Remove</button>
                    </form>
                </div>
            @endforeach

            <!-- Add a form for the purchase action -->
            <form action="{{ route('purchase') }}" method="post">
                @csrf
                <button type="submit">Purchase</button>
            </form>
            
        @else
            <p>Your cart is empty.</p>
        @endif

    </div>

    <!-- Add your footer scripts or links here -->

</body>

</html>
