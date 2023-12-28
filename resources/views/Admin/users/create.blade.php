@extends('layouts.Admin.app')
@section('page', 'Create User')
@section('content')
    {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'id' => 'user']) !!}
    @csrf
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Create New User</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Create</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name<span class="text-danger">*</span></label>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Email<span class="text-danger">*</span></label>
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Number</label>
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
                    <label>Password<span class="text-danger">*</span></label>
                    {!! Form::password('password', ['placeholder' => 'Password', 'id' => 'password', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Confirm Password<span class="text-danger">*</span></label>
                    {!! Form::password('confirmPassword', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Role</label>
                    <select name="roles[]" id="" class="form-control" multiple>
                        <option selected disabled>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Status<span class="text-danger">*</span></label>
                    {!! Form::select('userStatus', ['1' => 'Active', '0' => 'InActive'], null, ['class' => 'form-control']) !!}
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
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
                    },
                    email: {
                        required: true,
                        email: true,

                    },
                    // number: {
                    //     required: true,
                    // },
                    password: {
                        required: true,
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password",
                    },
                    roles: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name  ",
                    },
                    email: {
                        required: "Please enter email  ",
                        email: "Please enter valid email"

                    },
                    // number: {
                    //     required: "Please enter number  ",
                    // },
                    password: {
                        required: "Please enter password ",
                    },
                    confirmPassword: {
                        required: "Please enter confirm password ",
                        equalTo: 'Password not match',
                    },
                    roles: {
                        required: "Please select role ",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>

@endsection
