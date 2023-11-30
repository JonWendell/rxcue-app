<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharma &mdash; Colorlib Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="/back/fonts/icomoon/style.css">

    <link rel="stylesheet" href="/back/css/bootstrap.min.css">
    <link rel="stylesheet" href="/back/css/magnific-popup.css">
    <link rel="stylesheet" href="/back/css/jquery-ui.css">
    <link rel="stylesheet" href="/back/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/back/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="/back/css/aos.css">

    <link rel="stylesheet" href="/back/css/style.css">
</head>

<body>

    <div class="site-wrap">

        <div class="site-navbar py-2">

            <!-- ... (your existing navbar code) ... -->

        </div>

        <div class="site-blocks-cover" style="background-image: url('/back/images/hero_1.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                        <div class="site-block-cover-content text-center">
                            <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
                            <h1>Welcome To Pharma</h1>
                            <p>
                                <a href="#" class="btn btn-primary px-5 py-3">Shop Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="title-section text-center col-12">
                        <h2 class="text-uppercase">Popular Products</h2>
                    </div>
                </div>

                <div class="row">
                    @foreach($inventoryData as $item)
                        <div class="col-sm-6 col-lg-4 text-center item mb-4">
                            <a href="/ordered"> <img src="/back/images/product_placeholder.png" alt="Image"></a>
                            <h3 class="text-dark"><a href="/ordered">{{ $item->item_name }}</a></h3>
                            <p class="price">$ {{ $item->price }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="shop.html" class="btn btn-primary px-4 py-3">View All Products</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="title-section text-center col-12">
                        <h2 class="text-uppercase">New Products</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 block-3 products-wrap">
                        <div class="nonloop-block-3 owl-carousel">
                            <!-- Display new products as per your requirement -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ... (rest of your HTML code) ... -->

    </div>

    <footer class="site-footer">
        <div class="container">
            <!-- ... (your existing HTML code) ... -->
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>

</body>

</html>
