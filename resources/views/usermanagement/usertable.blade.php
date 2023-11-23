
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
</head>
<body>
    <h2>Users</h2>

    <table border="1">
        <thead>
            <tr>     
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th> <!-- New column for action buttons -->
            </tr>
        </thead>
        <tbody>
            @foreach($user_table as $key=>$items)
                <tr>
                    <td>{{ $items->name }}</td>
                    <td>{{ $items->username }}</td>
                    <td>{{ $items->email }}</td>
                    <td>{{ $items->created_at }}</td>    
                    <td>
                        <a href="{{ route('editUser', ['id' => $items->id]) }}">Edit</a>
                        |
                        <a href="{{ route('archiveUser', ['id' => $items->id]) }}">Archive</a>
                    </td>    
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
