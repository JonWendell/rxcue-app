@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<body>
    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">View Inventory</h2>

            <!-- Add this at the top of your Blade view, before the table -->
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

            <table class="table nowrap">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Previous Quantity</th>
                        <th>Added/Removed</th>
                        <th>New Quantity</th>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                    <tr>
                        <td class="table-plus">{{ $inventory->item_name }}</td>
                        <td>{{ $inventory->previous_quantity }}</td>
                        <td>{{ $inventory->quantity_change }}</td>
                        <td>{{ $inventory->new_quantity }}</td>
                        <td>{{ $inventory->change_date }}</td>
                        <td>
                            @if($inventory->image)
                            <img src="{{ asset('storage/images/' . $inventory->image) }}"
                                alt="{{ $inventory->item_name }}" style="max-width: 100px;">
                            @else
                            No Image
                            @endif
                        </td>
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
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Check if added quantities exist before iterating -->
                    @if($inventory->addedQuantities)
                    @foreach($inventory->addedQuantities as $addedQuantity)
                    <tr>
                        <td></td>
                        <td>{{ $addedQuantity->previous_quantity }}</td>
                        <td>{{ $addedQuantity->quantity_change }}</td>
                        <td>{{ $addedQuantity->new_quantity }}</td>
                        <td>{{ $addedQuantity->change_date }}</td>
                        <td></td> <!-- Empty column for consistency -->
                        <td></td> <!-- Empty column for consistency -->
                    </tr>
                    @endforeach
                    @endif
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
