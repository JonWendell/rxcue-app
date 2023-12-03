@extends('back.layout.main-layout')
@section('pageTitle', 'Audit History')
@section('content')

<div class="card-box mb-30">
    <div class="table-responsive">
        <div class="row">
            <div class="col-md-6">
                <h2 class="h4 pd-20">Audit History for {{ $inventory->item_name }}</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('inventory.index') }}" class="btn btn-primary">Back to Inventory</a>
            </div>
        </div>

        <table class="table nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Current Quantity</th>
                    <th>Quantity</th>
                    <th>New Stock</th>
                    <th>Type</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventory->audits as $audit)
                <tr>
                    <td>{{ $audit->id }}</td>
                    <td>{{ $audit->current_quantity }}</td>
                    <td>{{ $audit->quantity }}</td>
                    <td>{{ $audit->new_stock }}</td>
                    <td>{{ $audit->type }}</td>
                    <td>{{ $audit->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
