"use strict";

// Class Definition
var KTLogin = function () {
    var _login;
    let _token = $('meta[name="csrf-token"]').attr('content');
    var _showForm = function (form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-signin-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    function loginUser(){
        $.ajax({
            url: '/dashboard/login',
            type: 'post',
            data: {
                email: $('#email').val(),
                password: $('#password').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (resp) {
                KTApp.unblock('body');
                if (resp.success == true) {
                    Swal.fire({
                        text: 'Login berhasil..!',
                        icon: 'success'
                    }).then((value) => {
                        document.location = '/dashboard';
                    });
                } else
                    Swal.fire({
                        html: resp.message,
                        icon: 'error'
                    });
            },
            error: function (resp) {
                KTApp.unblock('body');
            },
            dataType: 'json'
        });
    }

    var _handleSignInForm = function () {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'),
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email tidak boleh kosong'
                            },

                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Password tidak boleh kosong'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();
            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    KTApp.block('body', {message: 'Login ke dashboard..'});
                        loginUser();
                } else {
                    swal.fire({
                        text: "Pastikan data yang dimasukkan benar!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
    }

    // Public Functions
    return {
        // public functions
        init: function () {
            _login = $('#kt_login');
            _handleSignInForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function () {
    KTLogin.init();
});
