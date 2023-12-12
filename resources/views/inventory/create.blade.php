@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Inventory</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 2%;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }

        h2 {
            background-color: #d2ebebe5;
            color: #fff;
            font-size: 1.25rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            text-decoration-color: #fff;
        }

        .card-body {
            padding: 1.25rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn-primary {
            color: #000000;
            background-color: #89b6e6;
            border-color: #89b6e6;
            width: 200px;
            align-content: center;
            text-align: center;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #6397ce;
            border-color: #89b0da;
        }
    </style>
</head>

<body>

    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">Add Product</h2>
            <div class="card-body">
                <!-- The form element starts here -->
                <form method="post" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" placeholder="Input product name"
                                required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" placeholder="Input product description"
                                rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="previous_quantity">Previous Quantity</label>
                            <input type="number" class="form-control" name="previous_quantity"
                            placeholder="Input previous quantity" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="quantity_change">Quantity Change</label>
                            <input type="number" class="form-control" name="quantity_change" placeholder="Change quantity"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="new_quantity">New Quantity</label>
                            <input type="number" class="form-control" name="new_quantity" placeholder="Input new quantity"
                            required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="change_date">Date</label>
                            <input type="date" class="form-control" name="change_date" placeholder="date" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select class="form-control" name="category">
                                <option value="fluid">Fluid</option>
                                <option value="solid">Solid</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Input product price"
                                required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="upc">UPC (Universal Product Code)</label>
                            <input type="text" class="form-control" name="upc" placeholder="Input UPC code">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
                <!-- The form element ends here -->
            </div>
        </div>
    </div>

</body>

</html>
@endsection
