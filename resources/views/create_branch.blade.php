<!-- resources/views/create_branch.blade.php -->

@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Branch</title>
</head>
<style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        margin-top: 5%;
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
<body>
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">Create Branch</h2>
        <div class="table-responsive">
            <div class="card-body">
                <form action="{{ route('branch.create') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name Of Branch</label>
                            <input type="text" class="form-control" name="name" placeholder="Branch Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" placeholder="Branch Location" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="contact">Contact Number</label>
                            <input type="text" class="form-control" name="contact" placeholder="Contact Number" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" name="status" placeholder="Status" required>
                        </div>
                    </div>

                    <div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="submit" class="btn btn-primary btn-block" value="Create Branch">
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Button to view branches -->
                <div class="text-left">
                    <div class="form-group col-md-6">
                        <a href="{{ route('branch.view') }}" class="btn btn-primary btn-block">View Branches</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

@endsection
