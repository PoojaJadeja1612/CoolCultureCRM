@extends('layouts.Admin.app')
@section('page', 'Mail Setting')
@section('content')
    <form id="setting_form" method="POST" action="{{ route('emailSettingUpdate') }}">
        @csrf
        <div class="card card-custom">
            <div class="card-header py-3">
                <div class="card-title ">
                    <h3 class="card-label font-weight-bolder text-dark">Mail Setting</h3>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('Dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Mailer</label>
                        <select class="form-control mailer" name="mailer" id="mailer">
                            <option>None</option>
                            <option value="smtp">SMTP</option>
                        </select>
                    </div>
                </div>
                <div id="smtpForm" style="display: none">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Host<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " placeholder="Enter email host" name="host"
                                value="{{ $companyMailSetting->host }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Port<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter email port " name="port"
                                value="{{ $companyMailSetting->port }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Encryption<span class="text-danger">*</span></label>
                            <select class="form-control" name="encryption" id="encryption">
                                <option selected disabled>None</option>
                                <option value="tls" @if ($companyMailSetting->encryption == 'tls') selected @endif>tls</option>
                                <option value="ssl" @if ($companyMailSetting->encryption == 'ssl') selected @endif>ssl</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Username<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter email username" name="userName"
                                value="{{ $companyMailSetting->userName }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter email password " name="password"
                                value="{{ $companyMailSetting->password }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>From Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter from email address"
                                name="fromAddress" value="{{ $companyMailSetting->fromAddress }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>From Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter from email Name" name="fromName"
                                value="{{ $companyMailSetting->fromName }}" />
                        </div>
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

    <script>
        jQuery(document).ready(function() {
            if ('{{ $companyMailSetting->mailer }}' == 'smtp') {
                $('.mailer').val('smtp');
                $('#smtpForm').css('display', 'block')
            }

            $(".mailer").change(function() {
                if ($(this).val() == 'smtp') {
                    $('#smtpForm').css('display', 'block')
                } else {
                    $('#smtpForm').css('display', 'none')
                }
            });

            jQuery('#setting_form').validate({
                errorClass: 'is-invalid',
                rules: {
                    host: {
                        required: true,
                    },
                    port: {
                        required: true,
                    },
                    encryption: {
                        required: true,
                    },
                    userName: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    },
                    fromAddress: {
                        required: true,
                    },
                    fromName: {
                        required: true,
                    },

                },
                messages: {
                    host: {
                        required: "Please enter host",
                    },
                    port: {
                        required: "Please enter port",
                    },
                    encryption: {
                        required: "Please select encryption",
                    },
                    userName: {
                        required: "Please enter email username",
                        email: "Please enter valid email username"
                    },
                    password: {
                        required: "Please enter password",
                    },
                    fromAddress: {
                        required: "Please enter mail from address",
                    },
                    fromName: {
                        required: "Please enter mail from name",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
