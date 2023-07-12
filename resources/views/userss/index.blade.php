@extends('layouts.appstisla')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></div>
                    <div class="breadcrumb-item">User</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="buttons">
                                <a href="#"
                                class="btn btn-icon icon-left btn-primary"
                                onclick="tambah()"><i class="far fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                        <div class="card-header">
                            <h4>User</h4>
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
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($all_users as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->roles->name }}</td>
                                        <td><a href="#"
                                                class="btn btn-outline-primary">Detail</a>
                                            <a href="#"
                                                class="btn btn-primary">Edit</a>
                                            <a href="#"
                                                class="btn btn-danger"
                                                data-toggle="tooltip"
                                                title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')">Hapus</a>
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
    <script src="{{ asset('stisla/library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- Page Specific JS File -->
<script>
//     function read(id) {
//     $.get("{{ url('tiket/read_status_tiket') }}/" + id, {}, function(data, status) {
//         $("#exampleModalLabel").html('Detail Tiket ' + id)
//         $("#page").html(data);
//         $("#exampleModal").modal('show');
//     });
// }

function tambah() {
  fetch("{{ route('indexTambahUser') }}")
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Tambah User';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show'); // Use jQuery to show the Bootstrap modal
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// function updateBtn(id) {
//     var formData = new FormData($('#formEditTiket')[0]);

//     $.ajax({
//         url: "{{ url('tiket/update_tiket') }}/" + id,
//         type: 'post',
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function(response) {
//             $('#exampleModal').modal('hide');
//             window.location.reload()
//             iziToast.success({
//                 title: 'Success',
//                 message: response.message,
//                 position: 'topRight',
//             });
//         },
//         error: function(xhr, status, error) {
//             console.log(error);
//         }
//     });
// }

function store() {
  const form = document.getElementById('formTambahUser');
  const formData = new FormData(form);

  fetch("{{ route('user.store') }}", {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      $('#exampleModal').modal('hide');
    //   window.location.reload();
      iziToast.success({
        title: 'Success',
        message: data.message,
        position: 'topRight'
      });
    })
    .catch(error => {
        iziToast.error({
        title: 'Error',
        message: 'Eror gagal tambah user',
        position: 'topRight'
      });
    });
}

</script>
@endpush
