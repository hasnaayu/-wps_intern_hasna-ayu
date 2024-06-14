@extends('layouts.master')
@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('contents')
    <!--begin::Notice-->
    <div class="col-lg-12 mt-40">
        <div class="col-4">
            <div class="d-flex flex-row mb-4">
                <div class="input-icon" id="kt_daterangepicker_2">
                    <input style="background-color: transparent" type="text" class="form-control"
                        placeholder="Select date range" />
                    <span><i class="ki ki-calendar icon-md text-primary"></i></span>
                </div>
                @if (request()->get('start_date') != null)
                    <a href="/dashboard/log"><span><i
                                class="fas
                            fa-times base_color mt-3 ml-2"></i></span></a>
                @endif
            </div>

            <a href="/dashboard/log/create" class="btn btn-light-primary font-weight-bolder">
                <i class="fas fa-plus mr-2"></i>
                Daily Log</a>
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
                            <th>Date</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ date('j M Y', strtotime($log->date)) }}</td>
                                <td>
                                    @if ($log->status == 'pending')
                                        <i class="fas fa-clock" data-toggle="tooltip" title="Pending"></i>
                                    @elseif ($log->status == 'approved')
                                        <i class="fas fa-check text-success" data-toggle="tooltip" title="Disetujui"></i>
                                    @else
                                        <i class="fas fa-times text-danger" data-toggle="tooltip" title="Ditolak"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a class="mr-6 detail" data-toggle="modal" data-target="#modal_task"
                                            data-toggle="tooltip" title="Detail" style="cursor: pointer"
                                            data-id={{ $log->id }}>
                                            <i class="fas fa-eye text-warning"></i>
                                        </a>
                                        <div class="delete_log cursor-pointer" data-id="{{ $log->id }}"
                                            data-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash text-danger"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>

        <div class="modal fade" id="modal_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title base_color">Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close close_btn"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="card p-3 my-3" style="border: 2px solid #58B0E2">
                            <div class="col-12">
                                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                    <thead>
                                        <tr>
                                            <th>Tugas</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="log_table" class="task_detail">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between" style="border-top: 0 none;">
                        <button type="button" class="btn btn-outline-secondary font-weight-bold text-dark close_btn"
                            data-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        let _token = $('meta[name="csrf-token"]').attr('content');
        var start_date = '';
        var end_date = '';
        let searchParams = new URLSearchParams(window.location.search); //how to get url object
        if (searchParams.get('start_date') || searchParams.get('end_date')) { //access query start and end date
            var start_val = moment(searchParams.get('start_date'));
            var end_val = moment(searchParams.get('end_date'));
            start_date = searchParams.get('start_date'); //parse to date
            end_date = searchParams.get('end_date');
            console.log(start_date);
            $('#kt_daterangepicker_2 .form-control').val(start_val.format('D MMMM YYYY') + ' - ' + end_val.format(
                'D MMMM YYYY'));
        }
        // input group and left alignment setup
        $('#kt_daterangepicker_2').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            start_date = start.format('YYYY-MM-DD');
            end_date = end.format('YYYY-MM-DD');
            $('#kt_daterangepicker_2 .form-control').val(start.format('D MMMM YYYY') + ' - ' + end.format(
                'D MMMM YYYY'));
            $('#kt_daterangepicker_2 .form-control').focus();
        });

        //cari
        $('#kt_daterangepicker_2').on('keypress', function(e) {
            if (e.which === 13) {
                window.location.href =
                    `/dashboard/log?start_date=${start_date}&end_date=${end_date}`;
            }
        });

        $(".delete_log").click(function(e) {
            var id_log = $(this).attr('data-id');
            Swal.fire({
                title: "Yakin ingin menghapus data daily log ini?",
                text: "Data daily log yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    KTApp.block('body', {
                        message: 'Menghapus data daily log...'
                    });
                    $.ajax({
                        url: '/dashboard/log/delete/' + id_log,
                        type: 'delete',
                        data: {
                            _token: _token
                        },
                        success: function(resp) {
                            console.log(resp);
                            KTApp.unblock('body');
                            if (resp.success == true) {
                                Swal.fire({
                                    text: 'Data daily log berhasil dihapus!',
                                    icon: 'success'
                                }).then((value) => {
                                    document.location = '/dashboard/log';
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
                        "Data daily log batal dihapus",
                    )
                }
            });
        });

        $('.detail').click(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                data: {
                    _token: _token
                },
                url: '/dashboard/log/detail/' + id,
                success: function(response) {
                    var content = $(".task_detail");
                    // $('#takedown_btn').attr('data-id', id_comment);
                    $.each(response.data, function(key, value) {
                        var id = value.id;
                        var title = value.title;
                        var is_done = value.is_done == true ? "Done" : "On Progress";
                        if (value.is_done == true) {
                            content.append(`
                            <tr>
                                <td>${title}</td>
                                <td><a href="/dashboard/log/is-done/${id}"><div class="btn btn-success disabled btn-block status_btn" style="cursor:default;">${is_done}</div></a></td>
                            </tr>
                        `)
                        } else {
                            content.append(`
                            <tr>
                                <td>${title}</td>
                                <td width=20%><a href="/dashboard/log/is-done/${id}"><div class="btn btn-warning disabled btn-block status_btn" style="cursor:default;">${is_done}</div></a></td>
                            </tr>
                            `)
                        };
                    });
                }
            });
        });

        $('.close_btn').on('click', function() {
            window.location.reload();
        });

        $('#modal_task').on('hidden.bs.modal', function() {
            window.location.reload();
        });
    </script>
@endsection
