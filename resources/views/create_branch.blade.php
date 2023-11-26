@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="main-container">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Branch</title>
</head>
<body>
    <h2>Create Branch</h2>

    <!-- Your form for creating a new branch -->
    <form action="{{ route('branch.create') }}" method="post">
        @csrf
        <!-- Input fields for branch information -->
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="location">Location:</label>
        <input type="text" name="location" required><br>

        <label for="contact">Contact Number:</label>
        <input type="text" name="contact" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" required><br>

        <input type="submit" value="Create Branch">
    </form>

    <!-- Button to view branches -->
    <a href="{{ route('branch.view') }}"><button>View Branches</button></a>

</body>
</html>
</div>
@endsection