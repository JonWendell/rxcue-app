@extends('back.layout.landing-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'About')
@section('content')
<!-- about.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>eMed - About</title>
</head>

<body>
    <h1>About Us</h1>
    <p>This is the content for the About page.</p>
</body>

</html>
@endsection