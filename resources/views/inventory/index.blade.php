@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<body>
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">View Inventory</h2>

        <!-- Display the branch information here -->
        @if(auth()->user()->branch)
            <div class="mb-3">
                <p><strong>Branch:</strong> {{ auth()->user()->branch->name }}</p>
                <!-- Adjust the field name according to your actual structure -->
                <p><strong>Location:</strong> {{ auth()->user()->branch->location }}</p>
            </div>
        @else
            <p><em>No branch information available for the current user.</em></p>
        @endif

        <!-- Add the search form -->
        <div class="mb-3">
            <form action="{{ route('inventory.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by item name" name="search"
                        value="{{ $search }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>UPC</th> <!-- Add this line for the new field -->
                        <th>Created At</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td class="table-plus">{{ $inventory->item_name }}</td>
                            <td>{{ $inventory->description }}</td>
                            <td>{{ $inventory->new_quantity }}</td>
                            <td>
                                @if($inventory->image)
                                <img src="{{ asset('/public/storage/images/' . $inventory->image) }}"
                                    alt="{{ $inventory->item_name }}" style="max-width: 100px;">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $inventory->category }}</td>
                            <td>₱{{ $inventory->price }}</td>
                            <td>{{ $inventory->upc }}</td> <!-- Add this line for the new field -->
                            <td>{{ $inventory->created_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item"
                                            onclick="redirectToAddPage('{{ $inventory->id }}')"><i
                                                class="dw dw-plus"></i> Add Quantity</a>
                                        <a class="dropdown-item"
                                            href="{{ route('inventory.audit', ['id' => $inventory->id]) }}"><i
                                                class="dw dw-history"></i> Audit History</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
