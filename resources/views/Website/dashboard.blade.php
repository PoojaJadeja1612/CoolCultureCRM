@extends('layouts.Website.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Customer Dashboard</div>
                    <div class="card-body">
                        <p>Welcome, {{ Auth::guard('customer')->user()->name }}!</p>
                        <p>This is your customer dashboard. You can add your content here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
