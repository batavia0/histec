@extends('layouts.appstisla')

@section('title', 'Mutasi Tiket')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="{{ asset('stisla/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}"> --}}
        <link rel="stylesheet"
        href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mutasi Tiket</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Tiket</a></div>
                    <div class="breadcrumb-item">Mutasi Tiket</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Mutasi Tiket</h4>
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
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>ID Tiket</th>
                                        <th>Email</th>
                                        <th>Dari Tanggal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Gambar</th>
                                    </tr>
                                    @php
                                    $i = ($all_tickets->currentPage() - 1) * $all_tickets->perPage() + 1;
                                    @endphp
                                        @foreach ($all_tickets as $row)
                                        
                                    <tr>
                                        <td>{{  $i++ }}</td>
                                        <td>{{ trim($row->tickets->name) }}</td>
                                        <td>{{ trim($row->tickets->description) }}</td>
                                        <td>{{ $row->tickets->ticket_no }}</td>
                                        <td>{{ $row->tickets->email }}</td>
                                        <td class="userDateTime">{{ $row->tickets->created_at }}</td>
                                        <td>
                                            <div class="badge badge-success">{{ $row->tickets->ticket_status->name }}</div>
                                            <div class="badge">{{ $row->tickets->category->name }}</div>
                                            <div class="badge">{{ $row->tickets->locations->name }}</div>
                                        </td>
                                        <td><a href="#"
                                                class="btn btn-sm btn-outline-primary"
                                                onclick="read({{ $row->ticket_id }})">Detail</a>
                                            <a href="#"
                                                class="btn btn-sm btn-info"
                                                data-toggle="tooltip"
                                                title="Mutasi Tiket"
                                                data-mutasi-id="{{ $row->ticket_id }}"
                                                ><i class="fas fa-handshake-alt"></i></a>
                                            <a href="#"
                                                class="btn btn-sm btn-primary"
                                                title="Update"
                                                onclick="edit({{ $row->ticket_id }})">Proses</a>
                                            {{-- <a href="#"
                                                class="btn btn-sm btn-danger"
                                                data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="deleteConfirm({{ $row->ticket_id }})">Hapus</a> --}}
                                            </td>
                                        <td>
                                            <a href="{{ asset('storage/' . trim($row->image)) }}">Gambar</a>
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#imageCollapse{{ $row->ticket_id }}" aria-expanded="true" aria-controls="imageCollapse">
                                                <i class="fas fa-compress-alt"></i>
                                            </button>
                                            <div id="imageCollapse{{ $row->ticket_id }}" class="collapse show">
                                                <img alt="{{ isset($row->image) ? $row->image : 'No Image' }}"
                                                    src="{{ isset($row->tickets->image) ? asset('storage/' . trim($row->tickets->image)) : 'No Image' }}"
                                                    width="200"
                                                    data-toggle="tooltip"
                                                    title="{{ isset($row->image) ? $row->image : 'No Image' }}"
                                                    loading="lazy">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <p class="text-center">{{ $all_tickets->isEmpty() ? 'NO DATA' : '' }}</p>

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
    <script src="{{ asset('js/jquery.doubleScroll.js') }}"></script>
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

function read(id) {
    $.get("{{ url('tiket/read_tiket') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#exampleModalLabel").html('Detail Tiket ' + id)
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}

function edit(id) {
    $.get("{{ url('tiket/edit_tiket_mutasi') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#exampleModalLabel").html('Mutasi Tiket ' + id)
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}

const btnMutasiElements = document.querySelectorAll('[data-mutasi-id]');
btnMutasiElements.forEach(btn => {
    btn.addEventListener('click', function() {
        // Get the 'id' value from the 'data-mutasi-id' attribute
        const id = this.getAttribute('data-mutasi-id');
        mutasiTiket(id);
    });
});

function mutasiTiket(id) {
  fetch("{{ url('tiket/mutasi_tiket_edit') }}/"+id)
    .then(response => response.text())
    .then(data => {
      document.getElementById("exampleModalLabel").innerHTML = 'Mutasi Tiket';
      document.getElementById("page").innerHTML = data;
      $('#exampleModal').modal('show'); // Use jQuery to show the Bootstrap modal
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function updateMutasiBtn(id) {
    const form = document.getElementById('formMutasiTiket');
    const formData = new FormData(form);

    fetch(`{{ url('tiket/mutasi_tiket_update') }}/${id}`, {
        method: 'POST',
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


$(document).ready(function(){
  $('.table-responsive').doubleScroll();
});
    </script>
@endpush
