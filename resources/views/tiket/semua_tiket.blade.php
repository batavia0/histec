@extends('layouts.appstisla')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}"> --}}
        <link rel="stylesheet"
        href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
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
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            id="search-input"
                                            placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox"
                                                    data-checkboxes="mygroup"
                                                    data-checkbox-role="dad"
                                                    class="custom-control-input"
                                                    id="checkbox-all">
                                                <label for="checkbox-all"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>ID Tiket</th>
                                        <th>Email</th>
                                        <th>Dari Tanggal</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Gambar</th>
                                    </tr>
                                    @php
                                    $i = ($all_tickets->currentPage() - 1) * $all_tickets->perPage() + 1;
                                    @endphp
                                        @foreach ($all_tickets as $row)
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox"
                                                    data-checkboxes="mygroup"
                                                    class="custom-control-input"
                                                    id="checkbox-{{ $row->ticket_id }}">
                                                <label for="checkbox-{{ $row->ticket_id }}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{  $i++ }}</td>
                                        <td>{{ trim($row->name) }}</td>
                                        <td>{{ trim($row->description) }}</td>
                                        <td>{{ $row->ticket_no }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ isset($row->ticket_finished_at)?($row->ticket_finished_at): '--|--' }}</td>
                                        <td>
                                            <div class="badge badge-success">{{ $row->ticket_status->name }}</div>
                                            <div class="badge">{{ $row->category->name }}</div>
                                            <div class="badge">{{ $row->locations->name }}</div>
                                        </td>
                                        <td><a href="#"
                                                class="btn btn-sm btn-outline-primary"
                                                onclick="read({{ $row->ticket_id }})">Detail</a>
                                            {{-- <a href="#"
                                                class="btn btn-sm btn-info"
                                                data-toggle="tooltip"
                                                title="Mutasi Tiket"><i class="fas fa-handshake-alt"></i></a> --}}
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
                                            <img alt="image"
                                                src="{{ $row->image }}"
                                                width="200"
                                                data-toggle="tooltip"
                                                title="{{ $row->image }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{-- Pagination --}}
                        <div class="card-footer text-right">
                            {{ $all_tickets->links() }}
                            @if ($all_tickets['links'])
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    @foreach ($all_tickets['links'] as $item)
                                    <li class="page-item {{ $item['active']?'active':'' }}"><a class="page-link"
                                        href="{{ $item['url'] }}">{!! $item['label'] !!}</a></li>
                                    @endforeach                                        
                                </ul>
                            </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Posts</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Introduction Laravel 5
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="text-center">{{ $all_tickets->isEmpty() ? 'NO DATA' : '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="d-inline">Tasks</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-1">
                                        <label class="custom-control-label"
                                            for="cbx-1"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-4.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Redesign header</a></h6>
                                        <div class="text-small text-muted">Alfa Zulkarnain <div class="bullet"></div>
                                            <span class="text-primary">Now</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-2"
                                            checked="">
                                        <label class="custom-control-label"
                                            for="cbx-2"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-5.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-primary float-right mb-1">Completed</div>
                                        <h6 class="media-title"><a href="#">Add a new component</a></h6>
                                        <div class="text-small text-muted">Serj Tankian <div class="bullet"></div> 4 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-3">
                                        <label class="custom-control-label"
                                            for="cbx-3"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-2.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-warning float-right mb-1">Progress</div>
                                        <h6 class="media-title"><a href="#">Fix modal window</a></h6>
                                        <div class="text-small text-muted">Ujang Maman <div class="bullet"></div> 8 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-4">
                                        <label class="custom-control-label"
                                            for="cbx-4"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Remove unwanted classes</a></h6>
                                        <div class="text-small text-muted">Farhan A Mujib <div class="bullet"></div> 21
                                            Min</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
         <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>


     <!-- Page Specific JS File -->
     <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>
     <script>
        $.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
     </script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase(); // Ambil nilai teks pencarian dan ubah ke huruf kecil

        // Saring baris tabel berdasarkan teks pencarian
        $('table tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.includes(searchValue)) {
                $(this).show(); // Tampilkan baris jika cocok dengan pencarian
            } else {
                $(this).hide(); // Sembunyikan baris jika tidak cocok dengan pencarian
            }
                });
            });
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
    </script>
    <script>
        function updateBtn(id) {
    var formData = new FormData($('#formEditTiket')[0]);

    $.ajax({
        url: "{{ url('tiket/update_tiket') }}/" + id,
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
    
        function read(id){
            $.get("{{ url('tiket/read_tiket') }}/" + id, {}, function(data, status) {
                    // jQuery.noConflict();
                    $("#exampleModalLabel").html('Detail Tiket '+ id)
                    $("#page").html(data);
                    $("#exampleModal").modal('show');
                });
        }
        function destroy(id){
            $.ajax({
                url: "{{ url('tiket/delete_tiket') }}/"+id,
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
                console.log(xhr,error);
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
