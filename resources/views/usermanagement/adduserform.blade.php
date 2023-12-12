<!-- resources/views/usermanagement/adduserform.blade.php -->

@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .card-box {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
            background-color: #fff;
        }

        h2 {
            background-color: #d2ebebe5;
            color: #fff;
            font-size: 1.25rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            text-decoration-color: #fff;
        }

        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .form-container {
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input,
        select {
            width: 100%;
            padding: 0.375rem 0.75rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        input[type="file"] {
            padding: 0;
            margin-bottom: 1rem;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 1rem;
        }
    </style>
</head>

<body>

   
        <h2 class="h4 pd-20">Add User</h2>

        @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- Your add user form goes here -->
        <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data" class="form-container">
            @csrf

            <!-- Your form fields go here -->
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required>

            <label for="middleName">Middle Name:</label>
            <input type="text" name="middleName">

            <label for="address">Address:</label>
            <input type="text" name="address">

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <!-- Add more gender options if needed -->
            </select>

            <label for="age">Age:</label>
            <input type="number" name="age">

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="client">Client</option>
                <option value="cashier">Cashier</option>
            </select>

            <label for="picture">Profile Picture:</label>
            <input type="file" name="picture" accept="image/*">

            <!-- Add more fields if needed -->

            <input type="submit" value="Add User" class="btn-primary">
            <a href="{{ route('userTable') }}" class="btn-secondary" style="text-align: left;">Go Back to User Table</a>
        </form>

</body>

</html>

@endsection
