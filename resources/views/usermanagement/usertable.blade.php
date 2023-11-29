@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">Users</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                        <!-- New column for action buttons -->
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
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a href="{{ route('editUser', ['id' => $items->id]) }}"
                                        class="dropdown-item"><i class="dw dw-edit2"></i> Edit</a>
                                    <a href="{{ route('archiveUser', ['id' => $items->id]) }}"
                                        class="dropdown-item"><i class="dw dw-delete-3"></i> Archive</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add User button -->
        <div class="text-right">
            <a href="{{ route('addUserForm') }}" class="btn btn-primary">Add User</a>
        </div>
    </div>
    </div>

    <script>
        function redirectToAddPage(id) {
            // Redirect to the page where you can add a new quantity for a specific item
            window.location.href = "{{ url('inventory/add') }}/" + id;
        }
    </script>

</body>
</html>
@endsection
