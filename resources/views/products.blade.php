@extends('back.layout.landing-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Products')
@section('content')
<!-- products.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>eMed - Products</title>
    <!-- Add your stylesheet link and other meta tags here -->
    <style>
        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 50px 0;
            margin-top: 2px;
            margin-bottom: 3px;
        }

        .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
        }

        .col-3 {
            flex: 1;
            padding: 20px;
        }

        .col-3 img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-details {
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-price {
            font-size: 1.5em;
            color: #27ae60;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="container-fluid">
            <!-- Product 1 -->
            <div class="col-3">
                <img src="/back/vendors/images/medicine1.webp" alt="Medicine Image 1">
                <div class="product-details">
                    <h2>Biogesic</h2>
                    <p>Biogesic contains active ingredient, making it effective in reducing pain and fever. </p>
                    <p class="product-price">9.99</p>
                    <!-- Add more product details as needed -->
                    <button>Add to Cart</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-3">
                <img src="/back/vendors/images/medicine2.webp" alt="Medicine Image 2">
                <div class="product-details">
                    <h2>Paracetamol</h2>
                    <p>Paracetamol is use for pain reliever, alleviates headaches, muscle aches, and minor pain 
                        associated with various conditions.</p>
                    <p class="product-price">14.99</p>
                    <!-- Add more product details as needed -->
                    <button>Add to Cart</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-3">
                <img src="/back/vendors/images/medicine3.webp" alt="Medicine Image 3">
                <div class="product-details">
                    <h2>Robitussin</h2>
                    <p>Robitussin has an active ingredient, provides effective cough suppression 
                        for individuals seeking relief from dry or non-productive coughs.</p>
                    <p class="product-price">19.99</p>
                    <!-- Add more product details as needed -->
                    <button>Add to Cart</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-3">
                <img src="/back/vendors/images/medicine4.webp" alt="Medicine Image 4">
                <div class="product-details">
                    <h2>Neozep</h2>
                    <p>Neozep is a dual-action over-the-counter medication that effectively relieves 
                        symptoms of the common cold and flu, providing relief from nasal congestion, 
                        fever, and body aches.</p>
                    <p class="product-price">24.99</p>
                    <!-- Add more product details as needed -->
                    <button>Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
