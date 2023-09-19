@extends('layouts.appstisla')

@section('title', 'Lokasi')

@push('style')
    <!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
<link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.0/rr-1.4.1/sc-2.2.0/sb-1.5.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Lokasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('lokasi.index') }}">Lokasi</a></div>
                    <div class="breadcrumb-item">Lokasi</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="buttons">
                                <a href=""
                                class="btn btn-icon icon-left btn-primary" id="btnTambah"><i class="far fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                        <div class="card-header">
                            <h4>Lokasi</h4>
                        </div>
                        <div class="card-body">
                            <table id="locations-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($all_locations as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" data-id="{{ $row->location_id }}">Detail</a>
                                            <a href="#" class="btn btn-sm btn-primary" title="Edit" data-edit-id="{{ $row->location_id }}">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus"
                                            data-delete-id="{{ $row->location_id }}">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($all_locations->isEmpty())
                                <p class="text-center">NO DATA</p>
                            @endif
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
    <!-- JS Libraries -->
    <script src="{{ asset('stisla/library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('stisla/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('stisla/library/jquery-ui-dist/jquery-ui.min.js') }}"></script> --}}

    <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>
 
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.0/rr-1.4.1/sc-2.2.0/sb-1.5.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script>

    <!-- Page Specific JS File -->
    <script>
        $('#locations-table').DataTable({
    "paging": true, // Menampilkan paging
    "searching": true, // Menampilkan fitur pencarian
    "ordering": true, // Mengizinkan pengurutan kolom
    "info": true, // Menampilkan informasi jumlah data
    "pageLength": 10, // Menampilkan 10 data per halaman
    "lengthMenu": [[3, 10, 50, 100, -1], [3, 10, 50, 100, "All"]], // Opsi jumlah data per halaman
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    }
});

const btnReadElements = document.querySelectorAll('[data-id]');
btnReadElements.forEach(btn => {
    btn.addEventListener('click', function() {
        // Get the 'id' value from the 'data-id' attribute
        const id = this.getAttribute('data-id');
        read(id);
    });
});

const btnTambah = document.getElementById('btnTambah');
btnTambah.addEventListener('click', (event) => {
    event.preventDefault();
    tambah();
});

function tambah(){
    fetch("{{ route('lokasi.create') }}")
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Tambah Lokasi';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show');
    })
    .catch(error => {
    alert('Terjadi kesalahan, '+error)
    });
}

function storeBtnLokasi(){
    event.preventDefault();
    const form = document.getElementById('formTambahLokasi');
    const formData = new FormData(form);
    const url = "{{ route('lokasi.store') }}";
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
                message: 'Terjadi Kesalahan',
                position: 'topRight'
            });
        });
}

const btnEditElements = document.querySelectorAll('[data-edit-id]');
btnEditElements.forEach(btn => {
    btn.addEventListener('click', function() {
        // Get the 'id' value from the 'data-edit-id' attribute
        const id = this.getAttribute('data-edit-id');
        edit(id);
    });
});

const btnDeleteElements = document.querySelectorAll('[data-delete-id]');
btnDeleteElements.forEach(btn => {
    btn.addEventListener('click', function() {
        // Get the 'id' value from the 'data-delete-id' attribute
        const id = this.getAttribute('data-delete-id');
        deleteConfirmLocation(id);
    });
});

function updateBtnLokasi(event,id){
    event.preventDefault();
    const form = document.getElementById('formUpdateLokasi');
    const formData = new FormData(form);
    const url = "{{ url('lokasi') }}/"+id;
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
            if (data.success === false) {
                $('#exampleModal').modal('hide');
                iziToast.success({
                    title: 'Success',
                    message: data.message,
                    position: 'topRight'
                });
                form.reset();
                form.querySelector('.text-danger').textContent = '';
            }
            if (data.errors) {
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
                message: 'Terjadi Kesalahan',
                position: 'topRight'
            });
        });
}

function read(id) {
  fetch("{{ url('lokasi') }}/"+id)
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Detail Lokasi';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show');
    })
    .catch(error => {
    alert('Terjadi kesalahan, '+error)
    });
}

function edit(id) {
  fetch("{{ url('lokasi/edit') }}/"+id)
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Edit Lokasi';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show'); // Use jQuery to show the Bootstrap modal
    })
    .catch(error => {
      console.error('Error:', error);
    });
}
function destroyLocation(id) {
    const url = "{{ url('lokasi/delete') }}/"+id;

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
                message: 'Terjadi kesalahan menghapus lokasi '+error,
                position: 'topRight'
            });
        });
}


function deleteConfirmLocation(id) {
    swal({
        title: 'Apakah Anda Yakin?',
        text: 'Anda Ingin Menghapus Lokasi',
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then((result) => {
        if (result) {
            destroyLocation(id);
        }
    });
}

    </script>
@endpush
