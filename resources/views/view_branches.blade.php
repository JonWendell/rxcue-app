@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="main-container">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Branches</title>
</head>
<body>
    <h2>View Branches</h2>

    <!-- Button to go back to /create-branch -->
    <a href="{{ route('branch.create.form') }}">ADD NEW BRANCH</a>

    @if(isset($branches) && count($branches) > 0)
        <table border="1">
            <thead>
                <tr>     
                    <th>Name</th>
                    <th>Location</th>
                    <th>Contact Number</th>
                    <th>Status</th>
                    <th>Action</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->location }}</td>
                        <td>{{ $branch->contact }}</td>
                        <td>{{ $branch->status }}</td>
                        <td>
                            <!-- Buttons for edit and archive -->
                            <form style="display: inline-block;" action="{{ route('branch.edit.form', ['id' => $branch->id]) }}" method="get">
                                <button type="submit">Edit</button>
                            </form>
                            <form style="display: inline-block;" action="{{ route('branch.archive', ['id' => $branch->id]) }}" method="post">
                                @csrf
                                @method('delete') <!-- Use DELETE method for delete operation -->
                                <button type="submit">Archive</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No branches found.</p>
    @endif

</body>
</html>
<div>
@endsection