
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch</title>
</head>
<body>
    <h2>Edit User</h2>

    @if(isset($admin))
        <!-- Your edit form goes here -->
        <form action="{{ route('updateUser', ['id' => $items->id]) }}" method="post">
            @csrf
            @method('put')

            <!-- Your form fields go here, pre-filled with branch data -->
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $items->name }}" required><br>
    

            <label for="location">Location:</label>
            <input type="text" name="location" value="{{ $items->username }}" required><br>

            <label for="contact">Contact Number:</label>
            <input type="text" name="contact" value="{{ $items->email }}" required><br>


            <input type="submit" value="Update Branch">
        </form>
    @else
        <p>No branch data found.</p>
    @endif

</body>
</html>
