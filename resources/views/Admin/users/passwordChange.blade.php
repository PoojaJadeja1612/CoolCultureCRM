@extends('layouts.Admin.app')
@section('page', 'Reset User Password')
@section('content')
    <form id="user" method="POST" action="/updatePassword/{{ $post->id }}" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header py-3">
                <div class="card-title">
                    <h3 class="card-label font-weight-bolder text-dark">Reset User Password</h3>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $post->name }}"
                            placeholder="Name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="email" name="email " class="form-control" value="{{ $post->email }}"
                            placeholder="Email" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Number</label>
                        <input type="text" onkeypress="return isNumber(event)" name="number" class="form-control"
                            value="{{ $post->number }}" placeholder="Number" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><b>Password:<em class="required">*</em></b></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label><b>Confirm Password:<em class="required">*</em></b></label>
                        <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
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
                rules: {
                    password: {
                        required: true,
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password",
                    },
                },
                messages: {
                    password: {
                        required: "Please enter password ",
                    },
                    confirmPassword: {
                        required: "Please enter confirm password ",
                        equalTo: 'Password not match',
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
