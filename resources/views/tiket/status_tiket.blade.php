@extends('layouts.appstisla')

@section('title', 'Status Tiket')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="{{ asset('stisla/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}"> --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Status Tiket</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Tiket</a></div>
                    <div class="breadcrumb-item">Status Tiket</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Status Tiket</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
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
                                        <th>#</th>
                                        <th>Nama Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($all_ticket_status as $row)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td><a href="#"
                                                class="btn btn-outline-primary" onclick="read({{ $row->status_id }})">Detail</a>
                                            <a href="#"
                                                class="btn btn-primary">Edit</a>
                                            {{-- <a href="#"
                                                class="btn btn-danger"
                                                data-toggle="tooltip"
                                                title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')">Hapus</a> --}}
                                            </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
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
    <!-- Page Specific JS File -->
    <script>
        $.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
     </script>
<script>
    function read(id) {
    $.get("{{ url('tiket/read_status_tiket') }}/" + id, {}, function(data, status) {
        $("#exampleModalLabel").html('Status Tiket')
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}
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
</script>
@endpush
