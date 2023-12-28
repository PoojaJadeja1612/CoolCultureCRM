@extends('layouts.Admin.app')
@section('page', 'Edit Technician')
@section('content')
    {!! Form::model($technician, ['method' => 'PATCH', 'id' => 'user', 'route' => ['technician.update', $technician->id]]) !!}
    @csrf
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Edit Technician</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('technician.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name<span class="text-danger">*</span></label>
                    {!! Form::text('technician_name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Email<span class="text-danger">*</span></label>
                    {!! Form::text('technician_email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Mobile Number</label>
                    {!! Form::text('technician_number', null, [
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
                    {!! Form::text('technician_address1', null, ['placeholder' => 'Address Line 1', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Address Line 2</label>
                    {!! Form::text('technician_address2', null, ['placeholder' => 'Address Line 2', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>City</label>
                    {!! Form::text('technician_city', null, ['placeholder' => 'City', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-4">
                    <label>State</label>
                    {!! Form::text('technician_state', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Country</label>
                    {!! Form::text('technician_contry', null, ['placeholder' => 'Contry', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Pincode</label>
                    {!! Form::text('technician_pincode', null, [
                        'placeholder' => 'Pincode',
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumber(event)',
                        'maxlength' => '6',
                    ]) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Status<span class="text-danger">*</span></label>
                    {!! Form::select('technician_status', ['1' => 'Active', '0' => 'InActive'], null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a href="{{ route('technician.index') }}" class="btn btn-secondary">Cancel</a>
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
                    technician_name: {
                        required: true,
                    },
                    technician_address1: {
                        required: true,
                    },
                },
                messages: {
                    technician_name: {
                        required: "Please enter name  ",
                    },
                    technician_address1: {
                        required: "Please enter Address 1  ",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>

@endsection
