@extends('layouts.appstisla')

@section('title', 'Kategori')

@push('style')
    <!-- CSS Libraries -->
        <link rel="stylesheet"
        href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kategori</a></div>
                <div class="breadcrumb-item">Kategori</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="card">
                    <div class="card-header">
                        <h4>Kategori</h4>
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
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                $i = ($all_category->currentPage() - 1) * $all_category->perPage() + 1;
                                @endphp
                                    @foreach ($all_category as $row)
                                <tr>
                                    <td>{{  $i++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td><a href="#"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="read({{ $row->category_id }})">Detail</a>
                                        {{-- <a href="#"
                                            class="btn btn-sm btn-info"
                                            data-toggle="tooltip"
                                            title="Mutasi Tiket"><i class="fas fa-handshake-alt"></i></a> --}}
                                        <a href="#"
                                            class="btn btn-sm btn-primary"
                                            title="Update"
                                            onclick="edit({{ $row->category_id }})">Edit</a>
                                        </td>
                                    </div>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    {{-- Pagination --}}
                    <div class="card-footer text-right">
                        {{ $all_category->links() }}
                        @if ($all_category['links'])
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                @foreach ($all_category['links'] as $item)
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
     {{-- <script src="{{ asset('stisla/library/prismjs/prism.js') }}"></script> --}}
         <!-- JS Libraies -->
    <script src="{{ asset('js/jquery.doubleScroll.js') }}"></script>
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
    $.get("{{ url('kategori') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#exampleModalLabel").html('Detail Kategori')
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
            $.get("{{ url('kategori') }}/" + id, {}, function(data, status) {
                    // jQuery.noConflict();
                    $("#exampleModalLabel").html('Detail Kategori '+ id)
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
$(document).ready(function(){
  $('.table-responsive').doubleScroll();
});

    </script>
@endpush
