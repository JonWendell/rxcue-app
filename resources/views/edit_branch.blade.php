<!-- resources/views/edit_branch.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch</title>
</head>
<body>
    <h2>Edit Branch</h2>

    @if(isset($branch))
        <!-- Your edit form goes here -->
        <form action="{{ route('branch.update', ['id' => $branch->id]) }}" method="post">
            @csrf
            @method('put')

            <!-- Your form fields go here, pre-filled with branch data -->
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $branch->name }}" required><br>
    

            <label for="location">Location:</label>
            <input type="text" name="location" value="{{ $branch->location }}" required><br>

            <label for="contact">Contact Number:</label>
            <input type="text" name="contact" value="{{ $branch->contact }}" required><br>

            <label for="status">Status:</label>
            <input type="text" name="status" value="{{ $branch->status }}" required><br>

            <input type="submit" value="Update Branch">
        </form>
    @else
        <p>No branch data found.</p>
    @endif

</body>
</html>
