<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>PT. Widya Presisi Solusi - {{ $title }}</title>
    <meta name="description" content="Reimbursement Website PT. Widya Presisi Solusi" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
        integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap4-datetimepicker@5.2.3/build/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    <!--end::Global Theme Styles(used by all pages)-->

    <style>
        body {
            background: #ffffff !important;
        }

        a[aria-expanded=true] .fa-caret-up {
            display: none !important;
        }

        a[aria-expanded=false] .fa-caret-down {
            display: none !important;
        }

        .base-text {
            color: #0000FF !important;
        }

        .base-border {
            border: 1px solid #0000FF !important;
        }

        .bg-primary {
            background-color: #0000FF !important;
        }

        .bg-secondary {
            background-color: #EAEAEA !important;
        }

        .rounded_icon {
            border-radius: 50%;
        }

        .floating-icon {
            position: absolute;
            /* You may need to change top and right. They depend on padding/widht of .badge */
            margin-top: -15px;
        }

        .btn-light-primary {
            background-color: #ceedff !important;
        }

        .btn.btn-light-primary:hover,
        .btn.btn-light-primary:active,
        .btn.btn-light-primary:visited {
            font-weight: 500;
            color: #0000FF !important;
            background-color: #ceedff !important;
        }

        .muted {
            accent-color: #BBBBBB;
            color: white;
        }

        .base_color {
            color: #0000FF;
        }

        .label.label-outline-success {
            background-color: transparent;
            color: #58B0E2 !important;
            border: 1px solid #58B0E2 !important;
        }

        .aside-minimize .aside-menu .menu-nav>.menu-item>.menu-link>.menu-icon {
            color: #B5B5C3 !important;
        }

        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading .menu-arrow,
        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-arrow {
            color: #fff;
        }

        .nav-item .nav-link.active {
            background-color: #D9F3DF !important;
            color: black !important;
            font-weight: 900;
            font-size: 18px;
            border-bottom: 6px solid #0000FF !important;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .nav-item .nav-link {
            color: black !important;
            font-weight: 900;
            font-size: 18px;
        }

        .btn.btn-outline-success {
            color: #0000FF;
            background-color: transparent;
            border-color: #0000FF !important;
        }

        .btn.btn-outline-success:hover,
        .btn.btn-outline-success:active,
        .btn.btn-outline-success:visited {
            color: #0000FF;
            background-color: #D9F3DF !important;
            border-color: #0000FF !important;
        }

        .btn.btn-outline-secondary:hover,
        .btn.btn-outline-secondary:active,
        .btn.btn-outline-secondary:visited {
            color: #0000FF;
            background-color: #D9F3DF !important;
            border-color: #0000FF !important;
        }

        .alert.alert-custom.alert-light-primary {
            background-color: #D9F3DF;
            border-color: transparent;
        }

        .alert {
            position: relative;
            padding: 1rem 1rem !important;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.8rem !important;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.5rem 1rem !important;
            font-size: 1rem;
            border-radius: 0.8rem !important;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #999999;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.8rem !important;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .input-container {
            display: block;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            color: #212529;
            background-color: #fff;
            border: 1px solid #999999;
            border-radius: 0.8rem !important;
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            .content-padding {
                margin-top: 0px !important;
            }
        }

        @media only screen and (min-width: 992px) {
            .content-padding {
                margin-top: 119px !important;
            }
        }

        .green-container {
            display: block;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            color: #212529;
            background-color: #D9F3DF;
            border: none;
            border-radius: 0.8rem !important;
        }

        .form-control-bottom {
            display: block;
            /* padding: 0.375rem 0.75rem; */
            font-size: 1rem;
            font-weight: 400;
            color: #212529;
            background-color: #fff;
            border: none !important;
            border-bottom: 1px solid #999999 !important;
            outline: none !important;
        }

        .form-control-noborder {
            display: block;
            /* padding: 0.375rem 0.75rem; */
            font-size: 1rem;
            font-weight: 400;
            color: #212529;
            background-color: #fff;
            border: none !important;
            outline: none !important;
        }

        select {
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            /* Remove default arrow */
            background: #ffffff url({{ asset('/img/select_arrow.png') }}) right 0.75rem center/12px 7px no-repeat !important;
            /* Add custom arrow */
        }

        .alert.alert-custom.alert-success {
            background-color: #0000FF !important;
            border-color: #0000FF !important;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: transparent;
            border: none !important;
            border-left: 1px solid #999999 !important;
            border-top: 1px solid #999999 !important;
            border-bottom: 1px solid #999999 !important;
            border-radius: 0.8rem;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            opacity: 1;
            background: #0000FF !important;
        }

        #kt_aside_menu {
            height: 80% !important;
        }

        .search_btn_container {
            background-color: #ceedff;
            padding: 1px;
            border-radius: 0.8rem !important;
            margin-top: 4px;
            margin-bottom: 4px;
            margin-right: 4px;
            margin-left: 10px !important;
            cursor: pointer;
        }

        .curr_container {
            background-color: #D9F3DF;
            padding: 1px;
            border: none !important;
            border-left: 1px solid #999999 !important;
            border-top: 1px solid #999999 !important;
            border-bottom: 1px solid #999999 !important;
            margin: 4px;
            cursor: pointer;
        }

        .form-control-datetime {
            display: block;
            width: 100%;
            height: calc(1.5em + 1.3rem + 2px);
            padding: 0.65rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #3F4254;
            background-color: #ffffff;
            background-clip: padding-box;
            /* border: 1px solid #999999; */
            border-left: none;
            border-top: 1px solid #999999 !important;
            border-bottom: 1px solid #999999 !important;
            border-right: 1px solid #999999 !important;
            border-radius: 0.8rem;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .form-control-subright {
            display: block;
            width: 100%;
            height: calc(1.5em + 1.3rem + 2px);
            padding: 0.65rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #3F4254;
            background-color: #ffffff;
            background-clip: padding-box;
            /* border: 1px solid #999999; */
            border-left: 1px solid #999999 !important;
            border-top: 1px solid #999999 !important;
            border-bottom: 1px solid #999999 !important;
            border-right: none !important;
            border-radius: 0;
            border-top-left-radius: 0.8rem;
            border-bottom-left-radius: 0.8rem;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .input-group>.form-control-datetime,
        .input-group>.form-control-plaintext,
        .input-group>.custom-select,
        .input-group>.custom-file {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
        }

        .text-secondary-30 {
            color: #1B1B1B;
            opacity: 0.3;
        }

        .icon-toggle[aria-expanded=false] .icon-expanded {
            display: none;
        }

        .icon-toggle[aria-expanded=true] .icon-collapsed {
            display: none;
        }
    </style>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" id="app"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->

    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <a href="index.html">
            <img alt="Logo" src="{{ asset('img/logo.png') }}" style="max-width : 120px" />
        </a>
        <!--end::Logo-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            {{-- <!--begin::Aside Mobile Toggle-->
            <button class="btn burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle--> --}}
            <!--begin::Header Menu Mobile Toggle-->
            <button class="btn mx-2" id="kt_aside_mobile_toggle">
                <i class="fas fa-bars fa-2x"></i>
            </button>
            <!--end::Header Menu Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Sidebar-->
            @include('layouts.sidebar')
            <!--end::Sidebar-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Navbar-->
                @include('layouts.navbar')
                <!--end::Navbar-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid  justify-content-start" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <!--begin::Page Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $title }}</h5>
                                <!--end::Page Title-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Toolbar-->
                            <div class="d-flex flex-column align-items-end">
                                <span class="text-dark text-sm" id="clock"></span>
                                <h6 class="text-dark font-weight-boldest">
                                    {{ \Carbon\Carbon::today()->translatedFormat('l') . ', ' . \Carbon\Carbon::today()->translatedFormat('d M Y') }}
                                </h6>
                            </div>
                            <!--end::Toolbar-->

                        </div>
                    </div>
                    <!--end::Subheader-->

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container-fluid" id="app">
                            @yield('contents')
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->

                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                @include('layouts.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->

    {{-- modal collections --}}
    @component('layouts.success_modal')
    @endcomponent
    @component('layouts.error_modal')
    @endcomponent
    @component('layouts.confirmation_modal')
    @endcomponent

    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>

    <!--begin::Global Config(global config for global JS scripts)-->
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
                        "primary": "#0000FF",
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
    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap4-datetimepicker@5.2.3/build/js/bootstrap-datetimepicker.min.js">
    </script>

    @yield('additional_scripts')
    <script>
        window.onload = function() {
            clock();

            function clock() {
                var now = new Date();
                var TwentyFourHour = now.getHours();
                var hour = now.getHours();
                var min = now.getMinutes();
                var sec = now.getSeconds();
                var mid = 'PM';
                if (min < 10) {
                    min = "0" + min;
                }
                if (hour > 12) {
                    hour = hour - 12;
                }
                if (hour == 0) {
                    hour = 12;
                }
                if (TwentyFourHour < 12) {
                    mid = 'AM';
                }
                document.getElementById('clock').innerHTML = hour + ':' + min + ' ' + mid;
                setTimeout(clock, 1000);
            }
        }
        let _token = $('meta[name="csrf-token"]').attr('content');

        function URL_add_parameter(url, param, value) {
            var hash = {};
            var parser = document.createElement('a');

            parser.href = url;

            var parameters = parser.search.split(/\?|&/);

            for (var i = 0; i < parameters.length; i++) {
                if (!parameters[i])
                    continue;

                var ary = parameters[i].split('=');
                hash[ary[0]] = ary[1];
            }

            hash[param] = value;

            var list = [];
            Object.keys(hash).forEach(function(key) {
                list.push(key + '=' + hash[key]);
            });

            parser.search = '?' + list.join('&');
            return parser.href;
        }

        function showConfirmationModal(title, desc, action) {
            $('#conf_modal_title').text(title)
            $('#conf_modal_question').text(desc)
            $('#confirmation_modal').modal('show');
            $('#conf_action_btn').click(action);
        }

        function showSuccessModal(title, desc, action) {
            $('#success_modal_title').text(title)
            $('#success_modal_desc').text(desc);
            $('#success_action_btn').click(action);
            $('#confirmation_modal').modal('hide');
            $('#success_modal').modal('show');
        }

        function showErrorModal(title, desc) {
            $('#err_modal_title').text(title)
            $('#err_modal_desc').text(desc);
            $('#confirmation_modal').modal('hide');
            $('#error_modal').modal('show');

        }
    </script>

</body>
<!--end::Body-->

</html>
