@extends('layouts.appstisla')

@section('title', 'User')

@push('style')
    <!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
@can('view-kepala-upttik')
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
                                                class="btn btn-outline-primary"
                                                data-id="{{ $row->id }}">Detail</a>
                                            <a href="#"
                                                class="btn btn-primary"
                                                data-toggle="tooltip"
                                                title="Edit"
                                                onclick="edit({{ $row->id }})">Edit</a>
                                            <a href="#"
                                                class="btn btn-danger"
                                                data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="deleteConfirmUser({{ $row->id }})">Hapus</a>
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
        @endcan
@endsection

@push('scripts')
    <!-- JS Libraies -->
<script src="{{ asset('stisla/library/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- jQuery validation plugin -->
{{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> --}}
    <!-- Page Specific JS File -->

<script>
function tambah() {
  fetch("{{ route('user.tambah') }}")
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

const btnReadElements = document.querySelectorAll('[data-id]');
btnReadElements.forEach(btn => {
    btn.addEventListener('click', function() {
        // Get the 'id' value from the 'data-id' attribute
        const id = this.getAttribute('data-id');
        read(id)
    });
});

function read(id) {
  fetch("{{ url('user') }}/"+id)
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Detail User';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show'); // Use jQuery to show the Bootstrap modal
    })
    .catch(error => {
    alert('Terjadi kesalahan, '+error)
    });
}

function edit(id) {
  fetch("{{ route('user.edit') }}/"+id)
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Edit User';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show'); // Use jQuery to show the Bootstrap modal
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function updateBtnUser(event, id){
    event.preventDefault();
    const form = document.getElementById('formUpdateUser');
    const formData = new FormData(form);
    const url = "{{ url('user/update') }}/"+id;

    fetch(url, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#exampleModal').modal('hide');
                window.location.reload();
                iziToast.success({
                    title: 'Success',
                    message: data.message,
                    position: 'topRight'
                });
                form.reset();
                form.querySelector('.text-danger').textContent = '';
            }
            else {
                form.querySelector('.text-danger').textContent = '';

                $.each(data.errors, function(index, message) {
                    var errorElement = $("#" + index + "_error");
                    errorElement.html(message);
                    iziToast.error({
                        title: 'Error',
                        message: 'Eror '+message,
                        position: 'topRight'
                    });
                });
            }
        })
        .catch(error => {
            iziToast.error({
                title: 'Error',
                message: 'Eror gagal menambahkan user',
                position: 'topRight'
            });
        });
}

function storeBtnUser(event) {
    event.preventDefault();
    const form = document.getElementById('formTambahUser');
    const formData = new FormData(form);
    const url = "{{ url('user/store') }}";

    fetch(url, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#exampleModal').modal('hide');
                window.location.reload();
                iziToast.success({
                    title: 'Success',
                    message: data.message,
                    position: 'topRight'
                });
                form.reset();
                form.querySelector('.text-danger').textContent = ''; // Menghapus pesan error
            } else {
                form.querySelector('.text-danger').textContent = ''; // Menghapus pesan error

                $.each(data.errors, function(index, message) {
                    var errorElement = $("#" + index + "_error");
                    errorElement.html(message);
                    iziToast.error({
                title: 'Error',
                message: 'Eror '+message,
                position: 'topRight'
            });
                });
            }
        })
        .catch(error => {
            iziToast.error({
                title: 'Error',
                message: 'Eror gagal menambahkan user',
                position: 'topRight'
            });
        });
}

function destroyUser(id) {
    const url = "{{ url('/user/destroy') }}/"+id;

    fetch(url, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
                iziToast.success({
                    title: 'Success',
                    message: data.message,
                    position: 'topRight'
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'Eror '+message,
                    position: 'topRight'
            });
            }
        })
        .catch(error => {
            iziToast.error({
                title: 'Error',
                message: 'Eror gagal menghapus user '+error,
                position: 'topRight'
            });
        });
}

function deleteConfirmUser(id) {
    swal({
        title: 'Apakah Anda Yakin?',
        text: "Anda Ingin Menghapus User",
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then((result) => {
        if (result) {
            destroyUser(id)
            swal({
                title: 'Terhapus',
                text: "Anda Telah Menghapus User",
                type: 'success'
            })
        }
    })
}
</script>
@endpush
