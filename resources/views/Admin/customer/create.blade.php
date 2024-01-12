@extends('layouts.Admin.app')
@section('page', 'Create Customer')
@section('content')
    {!! Form::open(['route' => 'customer.store', 'method' => 'POST', 'id' => 'user']) !!}
    @csrf
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Create New Customer</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Create</button>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name<span class="text-danger">*</span></label>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Email</label>
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Mobile Number</label>
                    {!! Form::text('number', null, [
                        'placeholder' => 'Number',
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumber(event)',
                        'maxlength' => '10',
                    ]) !!}
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-4">
                    <label>Address Line 1<span class="text-danger">*</span></label>
                    {!! Form::text('address1', null, ['placeholder' => 'Address Line 1', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Address Line 2</label>
                    {!! Form::text('address2', null, ['placeholder' => 'Address Line 2', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>City</label>
                    {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-4">
                    <label>State</label>
                    {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Country</label>
                    {!! Form::text('contry', null, ['placeholder' => 'Contry', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Pincode</label>
                    {!! Form::text('pincode', null, [
                        'placeholder' => 'Pincode',
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumber(event)',
                        'maxlength' => '6',
                    ]) !!}
                </div>
            </div>

            {{-- <div class="row">
                <div class="form-group col-md-4">
                    <label>Status<span class="text-danger">*</span></label>
                    {!! Form::select('userStatus', ['1' => 'Active', '0' => 'InActive'], null, ['class' => 'form-control']) !!}
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="form-group col-md-4">
                    <label><input type="checkbox" name="password" id="" value="password" /> Send email for
                        password</label>
                </div>
            </div> --}}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('script')

    <script type="text/javascript">
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#user').validate({
                errorClass: 'is-invalid',
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    email: {
                        maxlength: 100,
                    },
                    address1: {
                        required: true,
                        maxlength: 100,
                    },
                    address2: {
                        maxlength: 100,
                    },
                    city: {
                        maxlength: 100,
                    },
                    state: {
                        maxlength: 100,
                    },
                    contry: {
                        maxlength: 100,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name  ",
                        maxlength: "Name cannot exceed 50 characters",
                    },
                    email: {
                        maxlength: "Email cannot exceed 100 characters",
                    },
                    address1: {
                        required: "Please enter Address Line 1  ",
                        maxlength: "Address Line 1 cannot exceed 100 characters",
                    },
                    address2: {
                        maxlength: "Address Line 2 cannot exceed 100 characters",
                    },
                    city: {
                        maxlength: "City cannot exceed 100 characters",
                    },
                    state: {
                        maxlength: "City cannot exceed 100 characters",
                    },
                    contry: {
                        maxlength: "City cannot exceed 100 characters",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>

@endsection
