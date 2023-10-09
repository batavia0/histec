@extends('layouts.appstisla')

@section('title', 'Semua Tiket')

@push('style')
    <!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
<link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sp-2.2.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Semua Tiket</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Tiket</a></div>
                <div class="breadcrumb-item">Semua Tiket</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Semua Tiket</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="all_tickets" class="table-striped table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>ID Tiket</th>
                                        <th>Email</th>
                                        <th>Dari Tanggal</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th class="no-export">Action</th>
                                        <th class="no-export">Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                $i = 1;
                                @endphp
                                @foreach ($all_tickets as $row)
                                <tr>
                                    <td>{{  $i++ }}</td>
                                    <td>{{ trim($row->name) }}</td>
                                    <td>{{ trim($row->description) }}</td>
                                    <td>{{ $row->ticket_no }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td class="userDateTime">{{ $row->created_at }}</td>
                                    <td class="userDateTime">{{ isset($row->ticket_finished_at)?($row->ticket_finished_at): '--|--' }}</td>
                                    <td>
                                        <div class="badge badge-success">{{ $row->ticket_status->name }}</div>
                                        <div class="badge">{{ $row->category->name }}</div>
                                        <div class="badge">{{ $row->locations->name }}</div>
                                    </td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="read({{ $row->ticket_id }})">Detail</a>
                                        <a href="#"
                                            class="btn btn-sm btn-primary"
                                            title="Update"
                                            onclick="edit({{ $row->ticket_id }})">Edit</a>

                                        <a href="#"
                                            class="btn btn-sm btn-danger"
                                            data-toggle="tooltip"
                                            title="Hapus"
                                            onclick="deleteConfirm({{ $row->ticket_id }})">Hapus</a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . trim($row->image)) }}">Gambar</a>
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#imageCollapse{{ $row->ticket_id }}" aria-expanded="true" aria-controls="imageCollapse">
                                            <i class="fas fa-compress-alt"></i>
                                        </button>
                                        <div id="imageCollapse{{ $row->ticket_id }}" class="collapse show">
                                            <img alt="{{ isset($row->image) ? $row->image : 'No Image' }}"
                                                src="{{ isset($row->image) ? asset('storage/' . trim($row->image)) : 'No Image' }}"
                                                width="200"
                                                data-toggle="tooltip"
                                                title="{{ isset($row->image) ? $row->image : 'No Image' }}"
                                                loading="lazy">
                                        </div>   
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
        {{--  --}}
        </section>
    </div>
        <div class="modal fade"
            tabindex="-1"
            role="dialog"
            id="exampleModal">
            <div class="modal-dialog"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div id="page"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
     {{-- <script src="{{ asset('stisla/library/prismjs/prism.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.doubleScroll.js') }}"></script>
    <script src="{{ asset('stisla/library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('stisla/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>

    {{-- Datatable --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sp-2.2.0/sr-1.3.0/datatables.min.js"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>
    <script>
        $('#all_tickets').DataTable({
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "pageLength": 10,
    "scrollY": true,
    dom: 'Blfrtip',
    buttons: [{
            extend: 'copy',
            text: '<i class="fa fa-copy"></i> Copy',
            //   className: 'btn btn-primary',
            exportOptions: {
                columns: ':not(.no-export)'
            }
        },
        {
            extend: 'csv',
            text: '<i class="fa fa-file-csv"></i> CSV',
            exportOptions: {
                columns: ':not(.no-export)'
            }
        },
        {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i> Excel',
            exportOptions: {
                columns: ':not(.no-export)'
            }
        },
        {
            extend: 'pdf',
            text: '<i class="fa fa-file-pdf"></i> PDF',
            exportOptions: {
                columns: ':not(.no-export)'
            },
            pageSize: 'A4',
            orientation: 'landscape'
        },
        {
            extend: 'print',
            text: '<i class="fa fa-print"></i> Print',
            exportOptions: {
                columns: ':not(.no-export)'
            }
        }
    ],
    "lengthMenu": [
        [3, 10, 50, 100, -1],
        [3, 10, 50, 100, "All"]
    ],
    "lengthChange": true,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    }
});

function edit(id) {
    $.get("{{ url('tiket/edit_tiket') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#exampleModalLabel").html('Edit Tiket ' + id)
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}

function updateMutasiTiket(id) {
    $.get("{{ url('tiket/edit_tiket') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#exampleModalLabel").html('Edit Tiket ' + id)
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}
    function updateBtn(id) {
        var formData = new FormData($('#formEditTiket')[0]);

        $.ajax({
            url: "{{ url('tiket/update_tiket') }}/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#exampleModal').modal('hide');
                window.location.reload()
                iziToast.success({
                    title: 'Success',
                    message: response.message,
                    position: 'topRight',
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

function read(id) {
    $.get("{{ url('tiket/read_tiket') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#exampleModalLabel").html('Detail Tiket ' + id)
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}

function destroy(id) {
    $.ajax({
        url: "{{ url('tiket/delete_tiket') }}/" + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        success: function(response) {
            window.location.reload()
            iziToast.success({
                title: 'Success',
                message: 'Berhasil dihapus',
                position: 'topRight'
            });
        },
        error: function(xhr, status, error) {
            console.log(xhr, error);
        }
    });
}

function deleteConfirm(id) {
    swal({
        title: 'Apakah Anda Yakin?',
        text: "Anda Ingin Menghapus Tiket ",
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then((result) => {
        if (result) {
            destroy(id)
            swal({
                title: 'Terhapus',
                text: "Anda Telah Menghapus Tiket ",
                type: 'success'
            })
        }
    })
}
    </script>
@endpush
