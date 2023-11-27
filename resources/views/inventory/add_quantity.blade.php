@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')


<!DOCTYPE html>
<html>
<head>
    <title>Add Quantity</title>
</head>
<body>
    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">Add Quantity for {{ $inventory->item_name }}</h2>
            <div class="card-body">
                <form method="post" action="{{ route('inventory.postAdd', ['id' => $inventory->id]) }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                    </div>
                    <div class="form-row" text-align: center;>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Add Quantity</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

@endsection