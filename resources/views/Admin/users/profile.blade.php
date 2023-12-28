@extends('layouts.Admin.app')
@section('page', ' My Profile')
@section('content')
    <form class="form" method="post" id="profile" action="/Admin/profileUpdate" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom card-stretch">
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">My Profile</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('Dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline" id="profileImage">
                            <div class="image-input-wrapper"
                                style="background-image: url({{ asset('ProfileImage/' . Auth::user()->profileImage) }})">
                            </div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="profileImage" accept="png,jpg,jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control " type="text" name="name" value="{{ Auth::user()->name }}"
                            placeholder="Enter your Name" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone<span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-phone"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="number" onkeypress="return isNumber(event)"
                                value="{{ Auth::user()->number }}" placeholder="Enter your phone" />
                        </div>
                        <label id="phone-number" class="is-invalid" for="number"></label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address<span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control " value="{{ Auth::user()->email }}" name="email"
                                placeholder="Enter your email" />
                        </div>
                        <label id="email-error" class="is-invalid" for="email"></label>
                    </div>
                </div>
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6 group">
                        <h5 class="font-weight-bold mt-10">Change Password</h5>
                        <span class="form-text text-muted mb-6">leave blank if you don't want to change it.</span>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">New Password
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control " type="password" name="password" id="password"
                            placeholder="Enter your new password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Confirm Password</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control " type="text" name="confirmPassword"
                            placeholder="Enter your confirm password" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('Dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>

    </form>
@endsection

@section('script')
    <script type="text/javascript">
        var profileImage = new KTImageInput('profileImage');

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
            $('#profile').validate({
                errorClass: 'is-invalid',
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    number: {
                        required: true,
                    },
                    confirmPassword: {
                        equalTo: "#password",
                    },
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter valid email"
                    },
                    number: {
                        required: "Please enter your phone",
                    },
                    confirmPassword: {
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
