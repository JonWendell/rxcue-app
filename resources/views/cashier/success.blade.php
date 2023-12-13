<!-- resources/views/cashier/success.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file, adjust as needed -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Purchase Successful</div>

                    <div class="card-body">
                        <p>{{ $successMessage }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
