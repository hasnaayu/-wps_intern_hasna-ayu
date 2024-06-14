@extends('layouts.master')
@section('contents')
    <form class="form content-padding" method="POST" id="add_log" action="{{ url('/dashboard/log/store') }}"
        enctype="multipart/form-data">
        @csrf

        @include('layouts.alert')

        <div class="card card-custom pb-5 mt-10">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h2 class="card-label font-weight-bold">Daily Log
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-1">
                        <h6 class="font-weight-bold">Nama</h6>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control selectpicker" name="user_id">
                            <option disabled>Pilih</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row align-items-center mt-2">
                    <div class="col-lg-1">
                        <h6 class="font-weight-bold">Tanggal</h6>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#kt_datetimepicker_2"
                                data-toggle="datetimepicker">
                                <span class="input-group-text" style="background-color: transparent">
                                    <i class="ki ki-calendar base_color"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control-datetime datetimepicker-input"
                                placeholder="Select date & time" data-target="#kt_datetimepicker_2" name="date"
                                required />
                        </div>
                    </div>
                </div>

                <div class="card-title mt-20">
                    <h5 class="card-label font-weight-bolder">Task</h5>
                </div>
                <table class="table table-separate table-checkable" id="emptbl">
                    <thead>
                        <tr>
                            <th class="text-center text-secondary">Title</th>
                            <th class="text-center text-secondary">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="newRow">
                        <tr>
                            <td class="text-center" id="col1" style="width: 30%";><input type="text"
                                    class="form-control" name="title[]" required></td>
                            <td class="text-center" id="col2" style="width: 70%";>
                                <select class="form-control select-status" name="is_done[]" id="is_done" required>
                                    <option></option>
                                    <option value="0">On Progress</option>
                                    <option value="1">Done</option>
                                </select>
                            </td>
                            <td class="text-center" id="col3"><button type="button" class="btn btn-link btnDelete"
                                    onclick="deleteRows()" style="text-decoration: none;"><small><i
                                            class="far fa-trash-alt icon-lg mr-1"></i></small></button>
                            </td>
                        </tr>
                    </tbody>
                    <table>
                        <tr>
                            <td><button type="button" class="btn btn-secondary" style="text-decoration: none;"
                                    id="addRow">
                                    <p class="base_color font-weight-boldest mt-2"><i
                                            class="fas fa-plus icon-md text-primary mr-1"></i>
                                        Baris</p>
                                </button></td>
                        </tr>
                    </table>
                </table>
            </div>
            <div class="col-12 d-flex flex-row justify-content-end mt-4">
                <button type="reset" class="btn btn-danger mr-2">Batal</button>
                <button type="submit" class="btn btn-primary mr-2 add_log">Simpan</button>
            </div>
        </div>

    </form>
@endsection
@section('additional_scripts')
    <script type="text/javascript">
        let _token = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let searchParams = new URLSearchParams(window.location.search);
            var index = 1;
            var new_data = 'new_' + index;
            $('#addRow').click(function() {
                $('#newRow').append(`
                <tr id="${new_data}">
                            <td class="text-center" id="col1" style="width: 10%";><input type="text"
                                    class="form-control" name="title[]" required></td>
                            <td class="text-center" id="col2" style="width: 8%";>
                                <select class="form-control select-status" name="is_done[]" id="is_done"
                                    required>
                                    <option></option>
                                    <option value="0">On Progress</option>
                                    <option value="1">Done</option>
                                </select>
                            </td>
                            <td class="text-center" id="col3"><button type="button" class="btn btn-link btnDelete"
                                    onclick="deleteRows()" style="text-decoration: none;" id="addRow"><small><i
                                            class="far fa-trash-alt icon-lg mr-1"></i></small></button>
                            </td>
                </tr>
                `);
                index++;
                new_data = 'new_' + index;
            })
        })

        $("#emptbl").on('click', '.btnDelete', function() {
            var table = document.getElementById('emptbl');
            var rowCount = table.rows.length;
            if (rowCount > '2') {
                $(this).closest('tr').remove();
            } else {
                alert('Tidak dapat menghapus baris. Minimal terdapat 1 baris.');
            }
        });
    </script>
@endsection
