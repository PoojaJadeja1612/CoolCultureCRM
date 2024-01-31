<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    {{-- {{ Auth::logout() }} --}}
    <title>@yield('page') | {{ $setting->companyName }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/customAdmin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('Logo/' . $setting->companyFavicon) }}" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="/path/to/select2.min.js"></script>
    <style>
        input[type='checkbox'] {
            accent-color: {{ $setting->primaryColor }} !important;
        }

        .dropdown-item:hover {
            background-color: {{ $setting->primaryColor }} !important;
        }

        .btn-primary {
            background-color: {{ $setting->primaryColor }} !important;
            border-color: {{ $setting->primaryColor }} !important;
            color: {{ $setting->primaryFont }} !important;
        }

        .btn-secondary {
            background-color: {{ $setting->secondaryColor }} !important;
            border-color: {{ $setting->secondaryColor }} !important;
            color: {{ $setting->secondaryFont }} !important;
        }

        .alert-success {
            background-color: {{ $setting->primaryColor }} !important;
            border-color: {{ $setting->primaryColor }} !important;
            color: {{ $setting->primaryFont }} !important;
        }

        .alert.alert-danger {
            background-color: {{ $setting->primaryColor }} !important;
            border-color: {{ $setting->primaryColor }} !important;
            color: {{ $setting->primaryFont }} !important;
        }

        .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-heading .menu-icon,
        .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-link .menu-icon {
            color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
        }

        .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-heading .menu-icon,
        .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-link .menu-icon {
            color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
        }

        a.text-hover-primary:hover,
        .text-hover-primary:hover {
            color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
        }

        .navi .navi-item .navi-link:hover {
            color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;

        }

        .navi .navi-item .navi-link:hover .navi-text {
            color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
        }

        .dataTables_wrapper .dataTable th.sorting_asc,
        .dataTables_wrapper .dataTable td.sorting_asc {
            color: {{ $setting->primaryColor }} !important;
        }

        .dataTables_wrapper .dataTable th.sorting_desc,
        .dataTables_wrapper .dataTable td.sorting_desc {
            color: {{ $setting->primaryColor }} !important;
        }

        .dataTables_wrapper .dataTable th.sorting_desc:after,
        .dataTables_wrapper .dataTable td.sorting_desc:after {
            color: {{ $setting->primaryColor }} !important;
        }

        .dataTables_wrapper .dataTable th.sorting_asc:before,
        .dataTables_wrapper .dataTable td.sorting_asc:before {
            color: {{ $setting->primaryColor }} !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item.active>.page-link {
            background-color: {{ $setting->primaryColor }} !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item:hover:not(.disabled)>.page-link {
            background-color: {{ $setting->primaryColor }} !important;
        }

        .custom-select:focus {
            border-color: {{ $setting->primaryColor }} !important;
        }

        .form-control:focus {
            border-color: {{ $setting->primaryColor }} !important;
        }

        select:focus>option:checked {
            background: {{ $setting->primaryColor }} !important;
        }

        .btn.btn-hover-primary:hover:not(.btn-text):not(:disabled):not(.disabled),
        .btn.btn-hover-primary:focus:not(.btn-text),
        .btn.btn-hover-primary.focus:not(.btn-text) {
            background-color: {{ $setting->primaryColor }} !important;
            border-color: {{ $setting->primaryColor }} !important;
            color: {{ $setting->primaryFont }} !important;
        }

        .btn.btn-clean:not(:disabled):not(.disabled):active:not(.btn-text) i,
        .btn.btn-clean:not(:disabled):not(.disabled).active i,
        .show>.btn.btn-clean.dropdown-toggle i,
        .show .btn.btn-clean.btn-dropdown i {
            color: {{ $setting->primaryColor }} !important;
        }

        .btn.btn-clean:hover:not(.btn-text):not(:disabled):not(.disabled) i,
        .btn.btn-clean:focus:not(.btn-text) i,
        .btn.btn-clean.focus:not(.btn-text) i {
            color: {{ $setting->primaryColor }} !important;
        }

        @media (min-width: 992px) {

            .brand .btn.active .svg-icon svg g [fill],
            .brand .btn:hover .svg-icon svg g [fill] {
                fill: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
            }

        }

        @media (max-width: 991.98px) {
            .header-mobile .burger-icon:hover span {
                background-color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
            }

            .header-mobile .burger-icon:hover span::before,
            .header-mobile .burger-icon:hover span::after {
                background-color: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
            }

            .header-mobile .btn.active .svg-icon svg g [fill],
            .header-mobile .btn:hover .svg-icon svg g [fill] {
                fill: {{ $setting->hovorColor == '#ffffff' ? $setting->primaryColor : $setting->hovorColor }} !important;
            }
        }
    </style>
</head>

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <a href="{{ route('Dashboard') }}">
            <img alt="Logo" src="{{ asset('Logo/' . $setting->companyLogo) }}" height="30" width="60" />
        </a>
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <div class="brand flex-column-auto" id="kt_brand">
                    <a href="{{ route('Dashboard') }}" class="brand-logo">
                        <img alt="Logo" src="{{ asset('Logo/' . $setting->companyLogo) }}" width="120"
                            height="50" />
                    </a>
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
                        data-menu-dropdown-timeout="500">
                        <ul class="menu-nav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('Dashboard') }}" class="menu-link">
                                    <i class="menu-icon flaticon-home"></i>
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>
                            @if (Auth::user()->hasPermissionTo('customer-list'))
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ route('customer.index') }}" class="menu-link">
                                        <i class="menu-icon flaticon-users"></i>
                                        <span class="menu-text">Customers</span>
                                    </a>
                                </li>
                            @endif
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('technician.index') }}" class="menu-link">
                                    <i class="menu-icon flaticon-users"></i>
                                    <span class="menu-text">Technicians</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('work.index') }}" class="menu-link">
                                    <i class="menu-icon flaticon-users"></i>
                                    <span class="menu-text">Work</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('activity.index') }}" class="menu-link">
                                    <i class="menu-icon flaticon-users"></i>
                                    <span class="menu-text">Activity</span>
                                </a>
                            </li>
                            {{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon flaticon-list"></i>
                                    <span class="menu-text">Product Manager</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Categories</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Products</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            {{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon flaticon-business"></i>
                                    <span class="menu-text">Sales</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Sales</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Sales Return / Cr. Note</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Payment In</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Quotation / Estimate</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            {{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon flaticon-bag"></i>
                                    <span class="menu-text">Purchases</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Purchase Master</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Purchase</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Purchase Return / Dr. Note</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Payment Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            {{-- <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <i class="menu-icon flaticon-car"></i>
                                    <span class="menu-text">Stock Transfer</span>
                                </a>
                            </li> --}}
                            {{-- <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <i class="menu-icon flaticon-gift"></i>
                                    <span class="menu-text">Stock Adjustment</span>
                                </a>
                            </li> --}}
                            {{-- <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <i class="menu-icon flaticon-user"></i>
                                    <span class="menu-text">Staff Members</span>
                                </a>
                            </li> --}}
                            {{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon flaticon-graphic"></i>
                                    <span class="menu-text">Reports</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Payments</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Stock Alert</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Sales Summary</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Stock Summary</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Rate List</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Product Sales Summary</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Users Reports</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet ">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Profit & Loss</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            {{-- <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <i class="menu-icon flaticon-computer"></i>
                                    <span class="menu-text">Online Order</span>
                                </a>
                            </li> --}}
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon flaticon-browser"></i>
                                    <span class="menu-text">Master</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        @if (Auth::user()->hasPermissionTo('user-list'))
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{ route('users.index') }}" class="menu-link">
                                                    <i class="menu-bullet ">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Users</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('company-list'))
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{ route('company.index') }}" class="menu-link">
                                                    <i class="menu-bullet ">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Company</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @if (Auth::user()->hasPermissionTo('company-setting') ||
                                    Auth::user()->hasPermissionTo('permission-list') ||
                                    Auth::user()->hasPermissionTo('role-list') ||
                                    Auth::user()->hasPermissionTo('email-setting'))
                                <li class="menu-item menu-item-submenu" aria-haspopup="true"
                                    data-menu-toggle="hover">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-icon flaticon-cogwheel"></i>
                                        <span class="menu-text">Settings</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            @if (Auth::user()->hasPermissionTo('company-setting'))
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('Setting') }}" class="menu-link">
                                                        <i class="menu-bullet ">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Company Settings</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('technicianReport') }}" class="menu-link">
                                                        <i class="menu-bullet ">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Technicians Report</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('customerReports') }}" class="menu-link">
                                                        <i class="menu-bullet ">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Customer Report</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('workReports') }}" class="menu-link">
                                                        <i class="menu-bullet ">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Work Report</span>
                                                    </a>
                                                </li>
                                            @if (Auth::user()->hasPermissionTo('permission-list'))
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('permission.index') }}" class="menu-link">
                                                        <i class="menu-bullet ">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Permission</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->hasPermissionTo('role-list'))
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('roles.index') }}" class="menu-link">
                                                        <i class="menu-bullet ">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Roles</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--
                                            if (Auth::user()->hasPermissionTo('email-setting')) {
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{ route('emailSetting') }}" class="menu-link">
                                                    <i class="menu-bullet ">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Email</span>
                                                </a>
                                            </li>
                                            }
                                        -->

                                        </ul>
                                    </div>
                                </li>
                            @endif
                            <li class="menu-item" aria-haspopup="true">
                                @if (Session::has('original_user_id'))
                                    <a href="{{ route('proxy.exit') }}" class="menu-link"
                                        onclick="event.preventDefault();
                        document.getElementById('proxy-logout-form').submit();">
                                        <i class="menu-icon flaticon-logout"></i>
                                        <span class="menu-text">Logout</span>
                                    </a>
                                @else
                                    <a href="{{ route('logout') }}" class="menu-link"
                                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                        <i class="menu-icon flaticon-logout"></i>
                                        <span class="menu-text">Logout</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div id="kt_header" class="header header-fixed">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        </div>
                        <div class="topbar">
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id="kt_quick_user_toggle">
                                    <span
                                        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                    <span
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                        <span
                                            class="symbol-label font-size-h5 font-weight-bold">{{ Auth::user()->name[0] }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    {{-- <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <div class="d-flex align-items-center flex-wrap mr-1">
                                <div class="d-flex align-items-baseline flex-wrap mr-5">
                                    <h5 class="text-dark font-weight-bold my-1 mr-5">@yield('page')</h5>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex flex-column-fluid">
                        <div class="container">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p class="mb-0">{{ $message }}</p>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">{{ date('Y') }}©</span>
                            <a href="/" target="_blank"
                                class="text-dark-75 text-hover-primary">{{ $setting->companyName }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">User Profile @if (Session::has('original_user_id'))
                    <b>(Proxy)</b>
                @endif
            </h3>
            <a class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <div class="offcanvas-content pr-5 mr-n5">
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <div class="symbol-label"
                        style="background-image:url('{{ asset('ProfileImage/' . Auth::user()->profileImage) }}')">
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary pointer">
                        {{ Auth::user()->name }}</a>

                    <div class="navi mt-2">
                        <a href="mailto:{{ Auth::user()->email }}" class="navi-item">
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-icon mr-1">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                    fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5"
                                                    r="2.5" />
                                            </g>
                                        </svg>
                                    </span>
                                </span>
                                <span class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
                            </span>
                        </a>
                        @if (Session::has('original_user_id'))
                            <a href="{{ route('proxy.exit') }}"
                                class="btn btn-sm btn-primary font-weight-bolder py-2 px-5"
                                onclick="event.preventDefault();
                        document.getElementById('proxy-logout-form').submit();">Sign
                                Out</a>
                            <form id="proxy-logout-form" action="{{ route('proxy.exit') }}" method="GET"
                                style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('logout') }}"
                                class="btn btn-sm btn-primary font-weight-bolder py-2 px-5"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Sign
                                Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        @endif

                    </div>
                </div>
            </div>
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <div class="navi navi-spacer-x-0 p-0">
                <a href="{{ route('Profile') }}" class="navi-item">
                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5"
                                                r="2.5" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">My Profile</div>
                            <div class="text-muted">Account settings and more
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @php
                use Carbon\Carbon;
                $time = explode(',', Auth::user()->last_login)[0];
                $formattedDate = Carbon::parse($time)->format('d F Y');
            @endphp
            <div class="lastLogin"><span><b>Current User Last Login:</b> {{ $formattedDate }}</span></div>
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
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js') }}"></script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/paginations.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </script>
    @yield('script')
</body>

</html>
