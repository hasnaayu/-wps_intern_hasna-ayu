@extends('layouts.master')
@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('contents')
    <!--begin::Notice-->
    <div class="col-lg-12 mt-40">

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
                                        <a class="mr-6 detail" id="detail_btn" data-toggle="tooltip" title="Detail"
                                            style="cursor: pointer" data-id={{ $log->id }}>
                                            <i class="fas fa-eye text-warning"></i>
                                        </a>
                                        <a href="/dashboard/log/accept-log/{{ $log->id }}" class="mr-6"
                                            data-toggle="tooltip" title="Accept" style="cursor: pointer">
                                            <i class="fas fa-check text-success"></i>
                                        </a>
                                        <a href="/dashboard/log/reject-log/{{ $log->id }}" class="mr-6"
                                            data-toggle="tooltip" title="Reject" style="cursor: pointer">
                                            <i class="fas fa-times text-danger"></i>
                                        </a>
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
        $("input[name='search_field']").keyup(function(e) {
            if (e.keyCode == 13) {
                var search_val = $("input[name='search_field']").val();
                window.location.href =
                    `/dashboard/log?keyword=${search_val}`;
            }
        });
        $('#search_btn').click(function(e) {
            var search_val = $("input[name='search_field']").val();
            window.location.href =
                `/dashboard/log?keyword=${search_val}`;
        })

        $('#detail_btn').click(function(e) {
            $('#modal_task').modal('show');
        })


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
                                <td><div class="btn btn-success disabled btn-block status_btn" style="cursor:default;">${is_done}</div></td>
                            </tr>
                        `)
                        } else {
                            content.append(`
                            <tr>
                                <td>${title}</td>
                                <td width=20%><div class="btn btn-warning disabled btn-block status_btn" style="cursor:default;">${is_done}</div></td>
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
