@extends('back.layout.landing-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
<!-- home.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>eMed - Home</title>
</head>

<body>
    <div class="col-12">
    Welcome to the Home Page
    This is the content for the Home page.
    </div>
</body>

</html>
@endsection