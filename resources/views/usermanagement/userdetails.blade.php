@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<h2>User Details</h2>

@if(isset($user))
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Created At:</strong> {{ $user->created_at }}</p>

    <!-- Add more user details if needed -->
    <p><strong>First Name:</strong> {{ $user->firstName }}</p>
    <p><strong>Last Name:</strong> {{ $user->lastName }}</p>
    <p><strong>Middle Name:</strong> {{ $user->middleName }}</p>
    <p><strong>Address:</strong> {{ $user->address }}</p>
    <p><strong>Gender:</strong> {{ $user->gender }}</p>
    <p><strong>Age:</strong> {{ $user->age }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>

    <!-- Add more fields if needed -->
@else
    <p>No user data found.</p>
@endif

<a href="{{ route('userTable') }}" class="btn btn-secondary">Go Back to User Table</a>

</body>
</html>
@endsection
