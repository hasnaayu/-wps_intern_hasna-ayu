@extends('layouts.master')
@section('contents')
    <form class="form content-padding" method="POST" id="add_employee" action="{{ url('/dashboard/employee/store') }}"
        enctype="multipart/form-data">
        @csrf

        @include('layouts.alert')

        <div class="card card-custom pb-5 mt-10">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h2 class="card-label font-weight-bold">Data Karyawan
                        <span class="d-block text-muted pt-2 font-size-sm">Masukkan data karyawan baru</span>
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">Posisi <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control selectpicker" name="role_id">
                            <option disabled>Pilih posisi</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">Nama <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama dengan benar"
                            required />
                    </div>
                </div>
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">Username <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="username" class="form-control"
                            placeholder="Masukkan usernama dengan benar" required />
                    </div>
                </div>
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">E-Mail <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-lg-9">
                        <input type="email" name="email" class="form-control"
                            placeholder="Masukkan E-Mail dengan benar" />
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-row justify-content-end mt-4">
                <button type="reset" class="btn btn-danger mr-2">Batal</button>
                <button type="submit" class="btn btn-primary mr-2 add_employee">Simpan</button>
            </div>
        </div>

    </form>
@endsection
@section('additional_scripts')
    <script type="text/javascript">
        let _token = $('meta[name="csrf-token"]').attr('content');
        validation = FormValidation.formValidation(
            KTUtil.getById('add_employee'), {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Nama karyawan harus diisi'
                            },
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Username karyawan harus diisi'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email harus diisi'
                            },

                        }
                    },
                    role: {
                        validators: {
                            notEmpty: {
                                message: 'Posisi harus diisi'
                            }
                        }
                    },

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('.add_employee').on('click', function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    $('#add_employee').submit();
                } else {
                    swal.fire({
                        text: "Mohon isi data dengan benar.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
    </script>
@endsection
