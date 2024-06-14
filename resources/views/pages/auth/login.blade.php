<!DOCTYPE html>
<html lang="en">

<!--begin::Head-->

<head>
    <base href="../../../../">
    <meta charset="utf-8" />
    <title>WPS Website</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('img/logo_img.jpg') }}" />
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading"
    style="background-color : #FAFAFA">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-center bgi-no-repeat">
                <div class="d-flex flex-column align-items-center">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-5">
                        <img src="{{ asset('img/logo.png') }}" class="max-h-120px" alt="" />
                    </div>
                    <div class="w-450px">
                        @include('layouts.alert')
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login-->
                    <div class="mb-5">
                        <h2 class="font-weight-boldest">Selamat Datang!</h2>
                    </div>
                    <div class="card card-custom p-10 bg-white border border-2 border-primary">

                        <!--begin::Login Sign in form-->
                        <div>
                            <form class="form" id="kt_login_signin_form">
                                <div class="form-group mb-5 text-center">
                                    <input
                                        class="form-control h-auto form-control-solid py-4 px-8 w-350px bg-white border-secondary"
                                        type="text" placeholder="Email" name="email" id="email"
                                        autocomplete="off" />
                                </div>
                                <div class="form-group mb-3 text-center">
                                    <div class="input-icon input-icon-right">
                                        <input
                                            class="form-control h-auto form-control-solid py-4 px-8 w-350px bg-white border-secondary"
                                            type="password" placeholder="Password" id="password" name="password" />
                                        <span><i class="fas fa-eye" style="cursor: pointer"
                                                id="password_icon"></i></span>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button id="kt_login_signin_submit"
                                        class="cursor-pointer btn btn-primary text-center font-weight-bold px-12 py-2 my-3 mx-4">Login</button>
                                </div>

                                <p class="mt-2 text-center">Copyright and License to PT. Widya Presisi Solusi</p>
                            </form>
                        </div>
                        <!--end::Login Sign in form-->

                    </div>
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->

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
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#663259",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#F4E1F0",
                        "secondary": "#ECF0F3",
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
                        "secondary": "#212121",
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
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
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
    <!--end::Global Theme Bundle-->

    <!--begin::Page Scripts(used by this page)-->
    <!--end::Page Scripts-->

    <script type="text/javascript">
        var x = document.getElementById("password");
        var x_icon = document.getElementById("password_icon");
        $('#password_icon').click(function() {
            console.log('clicked!');
            if (x.type === "password") {
                x.type = "text";
                x_icon.className = 'fas fa-eye-slash'
            } else {
                x.type = "password";
                x_icon.className = 'fas fa-eye'

            }
        });
    </script>

    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>
<!--end::Body-->

</html>
