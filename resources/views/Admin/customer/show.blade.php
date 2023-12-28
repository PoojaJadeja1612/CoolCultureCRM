@extends('layouts.Admin.app')
@section('page', 'Customer Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Customer Details
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('customer.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Mobile Number:</strong>
                        {{ $user->number }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Address1:</strong>
                        {{ $user->address1 }}, {{ $user->address2 }}, {{ $user->city }}, {{ $user->state }}, {{ $user->contry }}, {{ $user->pincode }}.
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Address2:</strong>
                        {{ $user->address2 }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pincode:</strong>
                        {{ $user->pincode }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>City:</strong>
                        {{ $user->city }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>State:</strong>
                        {{ $user->state }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Contry:</strong>
                        {{ $user->contry }}
                    </div>
                </div> --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        @if ($user->userStatus == '0')
                            <label class="">Inactive</label>
                        @else
                            <label class="">Active</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
