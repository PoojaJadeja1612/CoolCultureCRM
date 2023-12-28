<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Page | {{ $setting->companyName }}</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/css/pages/login/login-2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('Logo/' . $setting->companyFavicon) }}" />
    <style>
        .btn-dark {
            background-color: {{ $setting->primaryColor }} !important;
            border-color: {{ $setting->primaryColor }} !important;
            color: {{ $setting->primaryFont }} !important;
        }

        .alert-success {
            background-color: {{ $setting->primaryColor }} !important;
            border-color: {{ $setting->primaryColor }} !important;
            color: {{ $setting->primaryFont }} !important;
        }

        label.error {
            color: red !important;
        }

        .text-primary {
            color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
        }

        a.text-hover-primary:hover,
        .text-hover-primary:hover {
            color: {{ $setting->secondaryColor }} !important;
        }

        .was-validated .form-control:invalid,
        .form-control.is-invalid {
            border-color: #F64E60 !important;
        }

        label.is-invalid {
            color: red !important;
        }
    </style>
</head>

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login">
            <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-4 px-7 py-lg-6 px-lg-35">
                    <a class="text-center pt-2">
                        <img src="{{ asset('Logo/' . $setting->companyLogo) }}" class="max-h-75px" alt="" />
                    </a>
                    <div class="d-flex flex-column-fluid flex-column flex-center">
                        <div class="login-form login-signin py-11">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p class="mb-0">{{ $message }}</p>
                                </div>
                            @endif
                            <form class="form" novalidate="novalidate" id="loginForm" method="POST"
                                action="{{ route('login') }}">
                                @csrf
                                <div class="text-center pb-8">
                                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h2>
                                </div>
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                    <input
                                        class="form-control form-control-solid h-auto py-3 px-4 rounded-lg @error('email') is-invalid @enderror"
                                        type="email" name="email" value="{{ old('email') }}"
                                        autocomplete="email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                    </div>
                                    <input
                                        class="form-control form-control-solid h-auto py-3 px-4 rounded-lg @error('password') is-invalid @enderror"
                                        type="password" name="password" autocomplete="off" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ url('Admin/password/reset') }}"
                                            class="text-primary font-size-h6 font-weight-bolder text-hover-primary"
                                            id="kt_login_forgot">Forgot Password ?</a>
                                    </div>

                                </div>
                                <div class="text-center pt-2">
                                    <button id="kt_login_signin_submit"
                                        class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign
                                        In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
                <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url(/assets/media/svg/illustrations/login-visual-2.svg);"></div>
            </div>
        </div>
    </div>

    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#loginForm').validate({
                errorClass: 'is-invalid',
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: "Please enter email",
                    },
                    password: {
                        required: "Please enter password",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script>
</body>

</html>
