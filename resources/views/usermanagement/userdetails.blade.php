@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            background-color: #bcdfdfe5;
            color: #000000;
            font-size: 1.25rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            text-decoration-color: #fff;
        }

        .details-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .details-section {
            flex: 1;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .details-section p {
            margin-bottom: 0.5rem;
        }

        .go-back-link {
            color: #0e0d0d;
            background-color: #74a8d5;
            border-color: #6c757d;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>

<body>

    <h2>User Details</h2>

    <div class="details-container">
        @if(isset($user))
        <div class="details-section">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Created At:</strong> {{ $user->created_at }}</p>

            <!-- Add more user details if needed -->
            <p><strong>First Name:</strong> {{ $user->firstName }}</p>
            <p><strong>Last Name:</strong> {{ $user->lastName }}</p>
            <p><strong>Middle Name:</strong> {{ $user->middleName }}</p>
        </div>

        <div class="details-section">
            <p><strong>Address:</strong> {{ $user->address }}</p>
            <p><strong>Gender:</strong> {{ $user->gender }}</p>
            <p><strong>Age:</strong> {{ $user->age }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
            
           <!-- Add more fields if needed -->
        </div>
        <div>
            <a href="{{ route('userTable') }}" class="go-back-link">Go Back to User Table</a>
        </div>
        @else
        <p>No user data found.</p>
        @endif
    </div>


</body>

</html>

@endsection
