<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Layout</title>
    <!-- Add your head elements here, such as meta tags, stylesheets, etc. -->
    <style>
      /* Add your styles here */
      .container {
          text-align: center;
          margin-top: 20px;
      }
  
      img {
          max-width: 100%;
          height: auto;
          margin-top: 10px;
          cursor: pointer;
          transition: transform 0.3s;
          /* Set a fixed width within the range of 600 to 800 pixels */
          width: 100%;
          max-width: 800px;
          min-width: 600px;
      }
  
      img:hover {
          transform: scale(1.2);
      }
  
      form {
          margin-top: 10px;
      }
  
      input {
          width: 50px;
      }
  
      button {
          margin-top: 10px;
          padding: 10px;
          background-color: #4CAF50;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
      }
  </style>
</head>

<body>

    <div class="container">
        @if(isset($product))
            <h2>{{ $product->item_name }}</h2>
            <a href="{{ asset('storage/images/' . $product->image) }}" target="_blank">
                <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-fluid">
            </a>
            <p>{{ $product->description }}</p>
            <p>Price: ${{ $product->price }}</p>

            <!-- Form for quantity and purchase -->
            <form action="/purchase" method="post">
                @csrf
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <button type="submit">Purchase</button>
            </form>

        @else
            <p>No product selected.</p>
        @endif
    </div>

    <!-- Add your footer scripts or links here -->

</body>

</html>
