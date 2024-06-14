@extends('layouts.master')
@section('contents')
    <div class="col-lg-12 mt-40">
        <div class="card card-custom mt-5">
            @if (auth()->user()->id == 1 || auth()->user()->id == 2 || auth()->user()->id == 3)
                <div class="col-4 my-4">
                    <a href="/dashboard/create" class="btn btn-light-primary font-weight-bolder">
                        <i class="fas fa-plus mr-2"></i>
                        Daily Log</a>
                </div>
            @endif

            <div class="row m-4">
                @foreach ($logs as $log)
                    <div class="col-lg-4 col-6">
                        @if ($log->status == 'pending')
                            <div class="card card-custom gutter-b secondary-border bg-secondary-o-15 detail cursor-pointer"
                                data-toggle="modal" data-target="#modal_task" data-id={{ $log->id }}>
                                <div class="card-body text-secondary font-weight-boldest">
                                    <div class="display-3 mb-3">
                                        {{ date('j M Y', strtotime($log->date)) }}
                                    </div>
                                    <h5>
                                        {{ $log->user->name }}
                                    </h5>
                                </div>
                            </div>
                        @else
                            <div class="card card-custom gutter-b {{ $log->status == 'approved' ? 'base-border' : 'danger-border' }} {{ $log->status == 'approved' ? 'bg-primary-o-15' : 'bg-danger-o-15' }} detail cursor-pointer"
                                data-toggle="modal" data-target="#modal_task" data-id={{ $log->id }}>
                                <div
                                    class="card-body {{ $log->status == 'approved' ? 'base-text' : 'text-danger' }} font-weight-boldest">
                                    <div class="display-3 mb-3">
                                        {{ date('j M Y', strtotime($log->date)) }}
                                    </div>
                                    <h5>
                                        {{ $log->user->name }}
                                    </h5>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
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
    <script>
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
