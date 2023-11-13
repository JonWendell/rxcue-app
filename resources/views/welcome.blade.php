<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        
    </head>
    <body>
        <div class="site-wrap">


            <div class="site-navbar py-2">
        
              <div class="search-wrap">
                <div class="container">
                  <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                  <form action="#" method="post">
                    <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
                  </form>
                </div>
              </div>
        
              <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="logo">
                    <div class="site-logo">
                      <a href="index.html" class="js-logo-clone">Pharma</a>
                    </div>
                  </div>
                  <div class="main-nav d-none d-lg-block">
                    <nav class="site-navigation text-right text-md-center" role="navigation">
                      <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="shop.html">Store</a></li>
                        <li class="has-children">
                          <a href="#">Dropdown</a>
                          <ul class="dropdown">
                            <li><a href="#">Supplements</a></li>
                            <li class="has-children">
                              <a href="#">Vitamins</a>
                              <ul class="dropdown">
                                <li><a href="#">Supplements</a></li>
                                <li><a href="#">Vitamins</a></li>
                                <li><a href="#">Diet &amp; Nutrition</a></li>
                                <li><a href="#">Tea &amp; Coffee</a></li>
                              </ul>
                            </li>
                            <li><a href="#">Diet &amp; Nutrition</a></li>
                            <li><a href="#">Tea &amp; Coffee</a></li>
                            
                          </ul>
                        </li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                      </ul>
                    </nav>
                  </div>
                  <div class="icons">
                    <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                    <a href="cart.html" class="icons-btn d-inline-block bag">
                      <span class="icon-shopping-bag"></span>
                      <span class="number">2</span>
                    </a>
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                        class="icon-menu"></span></a>
                  </div>
                </div>
              </div>
            </div>
        
            <div class="site-blocks-cover" style="background-image: url('/back/images/hero_1.jpg');">
              <div class="container">
                <div class="row">
                  <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                    <div class="site-block-cover-content text-center">
                      <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
                      <h1>Welcome To Rxcue</h1>
                      <p>
                        <a href="#" class="btn btn-primary px-5 py-3">Shop Now</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
    </body>
    
        <script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
    </body>
</html>
