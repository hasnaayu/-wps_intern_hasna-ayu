@extends('layouts.master')
@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('contents')
    <!--begin::Notice-->
    <div class="col-lg-12 mt-40">
        <div class="col-12">
            <div class="content-padding d-flex justify-content-start align-items-center mb-3">
                <div class="input-icon input-icon-right">
                    <input type="text" value="{{ request()->get('keyword') }}" class="form-control" name="search_field"
                        placeholder="Cari data karyawan..." />
                    <span class="search_btn_container" id="search_btn"><i class="fas fa-search text-primary"></i></span>
                </div>
                @if (request()->get('keyword') != null)
                    <a href="/dashboard/employee" class="ml-2"><span><i class="fas fa-times text-danger"></i></span></a>
                @endif
            </div>
            @can('manage-employees')
                <a href="/dashboard/employee/create" class="btn btn-light-primary font-weight-bolder">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data Karyawan</a>
            @endcan
        </div>

        <div class="my-5">
            @include('layouts.alert')
        </div>

        <div class="card card-custom mt-5">
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>E-Mail</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            @can('manage-employees')
                                <th>Tindakan</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->user_id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td
                                    class="font-weight-boldest {{ $user->is_active == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $user->is_active == 1 ? 'Aktif' : 'Nonaktif' }}</td>
                                @can('manage-employees')
                                    <td>
                                        <div class="d-flex flex-row">
                                            <a href="/dashboard/employee/edit/{{ $user->id }}" class="mr-6"
                                                data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <div class="change_status cursor-pointer mr-6" data-id="{{ $user->id }}"
                                                data-status="{{ $user->is_active }}" data-toggle="tooltip"
                                                title="{{ $user->is_active == 1 ? 'nonaktifkan' : 'aktifkan' }}">
                                                <i
                                                    class="fas fa-power-off {{ $user->is_active == 1 ? 'text-secondary' : 'text-success' }}"></i>
                                            </div>
                                            <div class="delete_employee cursor-pointer" data-id="{{ $user->id }}"
                                                data-toggle="tooltip" title="Hapus permanen">
                                                <i class="fas fa-trash text-danger"></i>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        let _token = $('meta[name="csrf-token"]').attr('content');
        $(".change_status").click(function(e) {
            var id_employee = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var title = status == 1 ? 'Menonaktifkan Karyawan' : 'Mengaktifkan kembali Karyawan';
            var desc = status == 1 ? 'Apa benar Anda ingin menonaktifkan status Karyawan ini?' :
                'Apa benar Anda ingin mengaktifkan kembali status Karyawan ini??';
            Swal.fire({
                title: title,
                text: desc,
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '/dashboard/employee/change-status/' + id_employee,
                        type: 'put',
                        data: {
                            _token: _token
                        },
                        success: function(resp) {
                            console.log(resp);
                            KTApp.unblock('body');
                            if (resp.success == true) {
                                Swal.fire({
                                    text: resp.message,
                                    icon: 'success'
                                }).then((value) => {
                                    document.location = '/dashboard/employee';
                                });
                            } else
                                Swal.fire({
                                    html: resp.message,
                                    icon: 'error'
                                })
                        },
                        error: function(resp) {
                            KTApp.unblock('body');
                        },
                        dataType: 'json'
                    });
                }
            });
        });
        $(".delete_employee").click(function(e) {
            var id_employee = $(this).attr('data-id');
            Swal.fire({
                title: "Yakin ingin menghapus data karyawan ini?",
                text: "Data karyawan yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    KTApp.block('body', {
                        message: 'Menghapus data karyawan...'
                    });
                    $.ajax({
                        url: '/dashboard/employee/delete/' + id_employee,
                        type: 'delete',
                        data: {
                            _token: _token
                        },
                        success: function(resp) {
                            console.log(resp);
                            KTApp.unblock('body');
                            if (resp.success == true) {
                                Swal.fire({
                                    text: 'Data karyawan berhasil dihapus!',
                                    icon: 'success'
                                }).then((value) => {
                                    document.location = '/dashboard/employee';
                                });
                            } else
                                Swal.fire({
                                    html: resp.message,
                                    icon: 'error'
                                })
                        },
                        error: function(resp) {
                            KTApp.unblock('body');
                        },
                        dataType: 'json'
                    });
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Data karyawan batal dihapus",
                    )
                }
            });
        });
        $("input[name='search_field']").keyup(function(e) {
            if (e.keyCode == 13) {
                var search_val = $("input[name='search_field']").val();
                window.location.href =
                    `/dashboard/employee?keyword=${search_val}`;
            }
        });
        $('#search_btn').click(function(e) {
            var search_val = $("input[name='search_field']").val();
            window.location.href =
                `/dashboard/employee?keyword=${search_val}`;
        })
    </script>
@endsection
