@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Cart')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Include any other CSS files if needed -->
    <title>Order</title>
</head>
<body>
    <div class="container">
        @if(isset($product))
        <h2>{{ $product->item_name }}</h2>
        <a href="{{ asset('storage/images/' . $product->image) }}" target="_blank">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-fluid">
        </a>
        <p>{{ $product->description }}</p>
        <p id="price">Price: ₱{{ $product->price }}</p> <!-- Changed $ to ₱ for pesos -->

        <!-- Form for quantity and purchase -->
        <form action="{{ route('addToCart', ['productId' => $product->id]) }}" method="post" oninput="updatePrice()">
            @csrf
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
        

        <script>
            // Initial product price
            var initialPrice = {{ $product->price }};
            
            function updatePrice() {
                // Get quantity and calculate total price
                var quantity = document.getElementById('quantity').value;
                var totalPrice = initialPrice * quantity;

                // Update the displayed price
                document.getElementById('price').innerText = 'Price: ₱' + totalPrice.toFixed(2); // Changed $ to ₱ for pesos
            }
        </script>

        @else
        <p>No product selected.</p>
        @endif
    </div>
</body>
</html>
@endsection