@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<<<<<<< HEAD

<h2>Edit User</h2>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch</title>
</head>
<body>
    <h2>Edit User</h2>
>>>>>>> 4e237fd2d9b9de0172f3b13f4c1fa01e61e5d372

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
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>

        <input type="submit" value="Update User">
    </form>


@else
    <p>No user data found.</p>
@endif

<<<<<<< HEAD
=======
</body>
</html>

>>>>>>> 4e237fd2d9b9de0172f3b13f4c1fa01e61e5d372
@endsection
