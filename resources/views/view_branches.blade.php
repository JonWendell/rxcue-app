@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Branches</title>
</head>
<body>
    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">View Branches</h2>

            <!-- Button to go back to /create-branch -->


            @if(isset($branches) && count($branches) > 0)
                <table class="table nowrap">
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
                                <td class="table-plus">{{ $branch->name }}</td>
                                <td>{{ $branch->location }}</td>
                                <td>{{ $branch->contact }}</td>
                                <td>{{ $branch->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <form style="display: inline-block;" action="{{ route('branch.edit.form', ['id' => $branch->id]) }}" method="get">
                                                <button class="dropdown-item" type="submit"><i class="dw dw-edit2"></i> Edit</button>
                                            </form>
                                            <form style="display: inline-block;" action="{{ route('branch.archive', ['id' => $branch->id]) }}" method="post">
                                                @csrf
                                                @method('delete') <!-- Use DELETE method for delete operation -->
                                                <button class="dropdown-item" type="submit"><i class="dw dw-delete-3"></i> Archive</button>
                                            </form>
                                        <form action="display: inline-block;">
                                            <a href="{{ route('branch.create.form') }}" class="dropdown-item"><i class="dw dw-add"></i> Add new branch</a>
                                        </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No branches found.</p>
            @endif
        </div>
    </div>
</body>

</html>
@endsection