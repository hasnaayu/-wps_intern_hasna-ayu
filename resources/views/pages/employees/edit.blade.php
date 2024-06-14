@extends('layouts.master')
@section('contents')
    <form class="form content-padding" method="POST" id="edit_employee"
        action="{{ url('/dashboard/employee/update/' . $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('layouts.alert')

        <div class="card card-custom pb-5 mt-10">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h2 class="card-label font-weight-bold">Data Karyawan
                        <span class="d-block text-muted pt-2 font-size-sm">Perbarui data karyawan</span>
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
                                <option {{ $user->role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">Nama <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                            placeholder="Masukkan nama dengan benar" />
                    </div>
                </div>
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">Usernama <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}"
                            placeholder="Masukkan usernama dengan benar" />
                    </div>
                </div>
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-3">
                        <h6 class="font-weight-bold">E-Mail</h6>
                    </div>
                    <div class="col-lg-9">
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                            placeholder="Masukkan E-Mail dengan benar" />
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-row justify-content-end mt-4">
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-danger mr-2">Batal</button>
                </a>
                <button type="submit" class="btn btn-primary mr-2 edit_employee">Simpan</button>
            </div>
        </div>

    </form>
@endsection
@section('additional_scripts')
    <script type="text/javascript">
        let _token = $('meta[name="csrf-token"]').attr('content');
        validation = FormValidation.formValidation(
            KTUtil.getById('edit_employee'), {
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

        $('.edit_employee').on('click', function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    $('#edit_employee').submit();
                } else {
                    swal.fire({
                        text: "Mohon isi data dengan lengkap.",
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
