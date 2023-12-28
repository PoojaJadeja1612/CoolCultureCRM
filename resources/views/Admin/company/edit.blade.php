@extends('layouts.Admin.app')
@section('page', 'Edit Company')
@section('content')
    <form id="setting_form" method="POST" action="{{ route('company.update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-custom">
            <div class="card-header py-3">
                <div class="card-title ">
                    <h3 class="card-label font-weight-bolder text-dark">Edit Company</h3>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('company.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control " placeholder="Enter company name" name="companyName"
                            value="{{ $data->companyName }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>GST</label>
                        <input type="text" class="form-control" placeholder="Enter GST number" name="gst"
                            value="{{ $data->gst }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>PAN</label>
                        <input type="text" class="form-control" placeholder="Enter PAN number" name="pan"
                            value="{{ $data->pan }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Contact Person<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter name of person" name="contactPerson"
                            value="{{ $data->contact_person }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter email" name="companyEmail"
                            value="{{ $data->companyEmail }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter phone number" name="companyPhone"
                            onkeypress="return isNumber(event)" value="{{ $data->companyPhone }}" />
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Address line 1<span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="1" name="addressLine1" placeholder="Enter address line 1">{{ $data->addressLine1 }}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Address line 2<span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="1" name="addressLine2" placeholder="Enter address line 2">{{ $data->addressLine2 }}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Country<span class="text-danger">*</span></label>
                        <select class="form-control  country" name="country" id="country">
                            <option selected disabled>Select country</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>State<span class="text-danger">*</span></label>
                        <select class="form-control state" name="state" id="state">
                            <option selected disabled>Select state</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>City<span class="text-danger">*</span></label>
                        <select class="form-control city" name="city" id="city">
                            <option selected disabled>Select city</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Pincode<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter pincode" name="pincode"
                            onkeypress="return isPincode(event)" value="{{ $data->pincode }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 logoColumn">
                        <div class="image-input image-input-outline" id="companySmallLogo">
                            <label>Small Logo</label>
                            <div class="image-input-wrapper"
                                style="background-image: url({{ asset('Logo/' . $data->companySmallLogo) }})">
                            </div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="companySmallLogo" accept="png,jpg,jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-4 logoColumn">
                        <div class="image-input image-input-outline" id="companyLogo">
                            <label>Logo</label>
                            <div class="image-input-wrapper companyLogo"
                                style="background-image: url({{ asset('Logo/' . $data->companyLogo) }})">
                            </div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="companyLogo" accept="png,jpg,jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-4 logoColumn">
                        <div class="image-input image-input-outline" id="companyFavicon">
                            <label>Favicon</label>
                            <div class="image-input-wrapper"
                                style="background-image: url({{ asset('Logo/' . $data->companyFavicon) }})">
                            </div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="companyFavicon" accept="png,jpg,jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="example-color-input" class="col-form-label">Primary Color</label>
                        <input class="form-control" type="color" value="{{ $data->primaryColor }}"
                            id="example-color-inputa" name="primaryColor" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="example-color-input" class="col-form-label">Primary Font</label>
                        <input class="form-control" type="color" value="{{ $data->primaryFont }}"
                            id="example-color-inputa" name="primaryFont" />
                    </div>

                    <div class="form-group col-md-2">
                        <label for="example-color-input" class="col-form-label">Secondary Color</label>
                        <input class="form-control" type="color" value="{{ $data->secondaryColor }}"
                            id="example-color-inputa" name="secondaryColor" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="example-color-input" class="col-form-label">Secondary Font</label>
                        <input class="form-control" type="color" value="{{ $data->secondaryFont }}"
                            id="example-color-inputa" name="secondaryFont" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="example-color-input" class="col-form-label">Hovor Color</label>
                        <input class="form-control" type="color" value="{{ $data->hovorColor }}"
                            id="example-color-inputa" name="hovorColor" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('company.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
@endsection

@section('script')

    <script>
        var companySmallLogo = new KTImageInput('companySmallLogo');
        var companySmallLogo = new KTImageInput('companyLogo');
        var companySmallLogo = new KTImageInput('companyFavicon');

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function isPincode(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        $(document).ready(function() {
            var token;
            $.ajax({
                type: 'GET',
                url: 'https://www.universal-tutorial.com/api/getaccesstoken',
                headers: {
                    'Accept': 'application/json',
                    'api-token': 'jAJuES2nNREYu0qOJ9Sy6bydr_LPxmjv0jUAR-oEuXozRP_CjqPqRgp1mCPaNh8VPZo',
                    'user-email': 'itjebasuthan@gmail.com'
                },
                success: function(data) {
                    token = data.auth_token;

                    $.ajax({
                        type: 'GET',
                        url: 'https://www.universal-tutorial.com/api/countries',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token + '',
                        },
                        success: function(data) {
                            for (let index = 0; index < data.length; index++) {
                                var select = '';
                                if (data[index].country_name ==
                                    '{{ $data->country }}') {
                                    select = 'selected';
                                }
                                $('.country').append('<option ' + select + ' value="' +
                                    data[index]
                                    .country_name +
                                    '">' + data[index].country_name +
                                    '</option>');
                            }
                            $('.country').trigger('change');
                        }
                    });
                }
            });

            $(".country").change(function() {
                $('.state').empty();
                var country = $('.country').val();
                $.ajax({
                    type: 'GET',
                    url: 'https://www.universal-tutorial.com/api/states/' + country + '',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token + '',
                    },
                    success: function(data) {
                        $('.state').append('<option selected disabled>Select state</option>');
                        for (let index = 0; index < data.length; index++) {
                            var select = '';
                            if (data[index].state_name ==
                                '{{ $data->state }}') {
                                select = 'selected';
                            }
                            $('.state').append('<option ' + select + ' value="' + data[index]
                                .state_name +
                                '">' + data[index].state_name +
                                '</option>');
                        }
                        $('.state').trigger('change');
                    }
                });
            });

            $(".state").change(function() {
                $('.city').empty();
                var state = $('.state').val();
                $.ajax({
                    type: 'GET',
                    url: 'https://www.universal-tutorial.com/api/cities/' + state + '',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token + '',
                    },
                    success: function(data) {
                        $('.city').append('<option selected disabled>Select city</option>');
                        for (let index = 0; index < data.length; index++) {
                            var select = '';
                            if (data[index].city_name ==
                                '{{ $data->city }}') {
                                select = 'selected';
                            }
                            $('.city').append('<option ' + select + ' value="' + data[index]
                                .city_name +
                                '">' + data[index].city_name +
                                '</option>');
                        }
                    }
                });
            });


        })
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#setting_form').validate({
                errorClass: 'is-invalid',
                rules: {
                    companyName: {
                        required: true,
                    },
                    contactPerson: {
                        required: true,
                    },
                    companyEmail: {
                        required: true,
                        email: true,
                    },
                    companyPhone: {
                        required: true,
                    },
                    addressLine1: {
                        required: true,
                    },
                    addressLine2: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    pincode: {
                        required: true,
                    },

                },
                messages: {
                    companyName: {
                        required: "Please enter company name",
                    },
                    contactPerson: {
                        required: "Please enter contact person name",
                    },
                    companyEmail: {
                        required: "Please enter company email",
                        email: "Please enter valid email"
                    },
                    companyPhone: {
                        required: "Please enter company phone",
                    },
                    addressLine1: {
                        required: "Please enter address line 1",
                    },
                    addressLine2: {
                        required: "Please enter address line 2",
                    },
                    country: {
                        required: "Please select country",
                    },
                    state: {
                        required: "Please select state",
                    },
                    city: {
                        required: "Please select city",
                    },
                    pincode: {
                        required: "Please enter pincode",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>

@endsection
