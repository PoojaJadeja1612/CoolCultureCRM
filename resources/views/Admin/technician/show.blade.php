@extends('layouts.Admin.app')
@section('page', 'Technician Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Technician Details
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('technician.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $technician->technician_name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $technician->technician_email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Mobile Number:</strong>
                        {{ $technician->technician_number }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Address1:</strong>
                        {{ $technician->technician_address1 }}, {{ $technician->technician_address2 }}, {{ $technician->technician_city }}, {{ $technician->technician_state }}, {{ $technician->technician_contry }}, {{ $technician->technician_pincode }} .
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
