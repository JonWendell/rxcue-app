<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Order</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional styles can be added here */

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        img:hover {
            transform: scale(1.2);
        }

        .container {
            margin: 0 auto;
            border: 1px solid #000000; /* Border color */
            border-radius: 5px; /* Optional: Adds rounded corners */
            padding: 20px; /* Optional: Adds padding inside the container */
        }

        #product-details {
            max-width: 800px;
            text-align: left;
        }

        form {
            margin-top: 5px;
        }

        label {
            margin-bottom: 5px;
            display: block;
        }

        #price {
            font-size: 1.25rem;
            color: #28a745;
        }

        /* Add a style for the notification container */
        .notification-container {
            margin-top: 10px;
        }

        /* Add background color to the header */
        h1 {
            background-color: #6090c4; /* You can change this color code */
            color: #fff; /* Text color */
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Product Order</h1>
        @if(isset($product))
        <div class="row">
            <div class="col-md-6">
                <div id="product-details">
                    <h2>{{ $product->item_name }}</h2>
                    <a href="{{ asset('storage/images/' . $product->image) }}" target="_blank">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image"
                            class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div id="product-details">
                    <p>{{ $product->description }}</p>
                    <p id="price" class="fw-bold">Price: ₱{{ $product->price }}</p>

                    <div class="notification-container">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('addToCart', ['productId' => $product->id]) }}" method="post"
                        oninput="updatePrice()">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var initialPrice = {{ $product->price }};
            
            function updatePrice() {
                var quantity = document.getElementById('quantity').value;
                var totalPrice = initialPrice * quantity;
                document.getElementById('price').innerText = 'Price: ₱' + totalPrice.toFixed(2);
            }
        </script>

        @else
        <p class="alert alert-warning">No product selected.</p>
        @endif
    </div>

    <!-- Add Bootstrap JS and Popper.js (dependency for Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
