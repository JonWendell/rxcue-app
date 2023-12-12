@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            background-color: #c5edede5;
            color: #000000;
            font-size: 1.25rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            text-decoration-color: #fff;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        form {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
            padding: 1.25rem;
        }

        label {
            margin-bottom: 0.5rem;
            display: block;
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
            padding: 0.375rem 0;
        }

        input[type="submit"] {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        p {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(isset($user))
    <!-- Your edit form goes here -->
    <form action="{{ route('updateUser', ['id' => $user->id]) }}" method="post">
        @csrf
        @method('post')

        <!-- Your form fields go here, pre-filled with user data -->
        <h2>Edit User</h2>

        <label for="username">Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>

        <label for="password">Password (Leave blank to keep current):</label>
        <input type="password" name="password"><br>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" value="{{ $user->firstName }}" required><br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" value="{{ $user->lastName }}" required><br>

        <label for="middleName">Middle Name:</label>
        <input type="text" name="middleName" value="{{ $user->middleName }}"><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="{{ $user->address }}"><br>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
            <!-- Add more gender options if needed -->
        </select><br>

        <label for="age">Age:</label>
        <input type="number" name="age" value="{{ $user->age }}"><br>

        <label for="role">Role:</label>
        <input type="text" name="role" value="{{ $user->role }}" required><br>

        <label for="picture">Profile Picture:</label>
        <input type="file" name="picture" accept="image/*"><br>

        <input type="submit" value="Update User">
    </form>
    @else
    <p>No user data found.</p>
    @endif

</body>

</html>


@endsection
