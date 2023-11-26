@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="main-container">
<!DOCTYPE html>
<html>
<head>
    <title>Add Quantity</title>
</head>
<body>
    <h1>Add Quantity for {{ $inventory->item_name }}</h1>

    <form method="post" action="{{ route('inventory.postAdd', ['id' => $inventory->id]) }}">
        @csrf
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        <button type="submit">Add Quantity</button>
    </form>
</body>
</html>
</div>
@endsection