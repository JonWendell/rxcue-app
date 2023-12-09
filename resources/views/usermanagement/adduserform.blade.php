<!-- resources/views/usermanagement/adduserform.blade.php -->

@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

    <div class="card-box mb-30">
        <h2 class="h4 pd-20">Add User</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Your add user form goes here -->
        <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Your form fields go here -->
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required><br>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required><br>

            <label for="middleName">Middle Name:</label>
            <input type="text" name="middleName"><br>

            <label for="address">Address:</label>
            <input type="text" name="address"><br>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <!-- Add more gender options if needed -->
            </select><br>

            <label for="age">Age:</label>
            <input type="number" name="age"><br>

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="client">Client</option>
                <option value="cashier">Cashier</option>
            </select><br>

            <label for="picture">Profile Picture:</label>
            <input type="file" name="picture" accept="image/*"><br>

            <!-- Add more fields if needed -->

            <input type="submit" value="Add User">
        </form>

        <a href="{{ route('userTable') }}" class="btn btn-secondary">Go Back to User Table</a>
    </div>

</body>
</html>
@endsection
