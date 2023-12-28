@extends('layouts.Admin.app')
@section('page', 'Dashboard')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    {{ __('Dashboard') }}
                </h3>
            </div>
        </div>
        <div class="card-body">
            Welcome to admin panel
        </div>
    </div>
@endsection
