@extends('layouts.appstisla')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}">
        <link rel="stylesheet"
        href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
        <link rel="stylesheet"
        href="{{ asset('stisla/library/selectric/public/selectric.css') }}">

@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>FAQ</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('indexFaqAdmin') }}">FAQ</a></div>
                    <div class="breadcrumb-item">FAQ</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="buttons">
                                <a href="#formTambahFaq"
                                class="btn btn-icon icon-left btn-primary"><i class="far fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                        <div class="card-header">
                            <h4>FAQ</h4>
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
                                        <th>Jawaban</th>
                                        <th>Kategori</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Tanggal dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                    @php
                                    $i = ($all_faq->currentPage() - 1) * $all_faq->perPage() + 1;
                                    @endphp

                                        @foreach ($all_faq as $row)
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox"
                                                    data-checkboxes="mygroup"
                                                    class="custom-control-input"
                                                    id="checkbox-1">
                                                <label for="checkbox-1"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{  $i++ }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{!! $row->answer !!}</td>
                                        <td>{{ $row->category->name }}</td>
                                        <td>{{ $row->users->name }} | {{ $row->users->email }}</td>
                                        <td id="userDateTime">{{ $row->created_at }}</td>
                                        <td><a href="#"
                                                class="btn btn-sm btn-outline-primary"">Detail</a>
                                            <a href="#"
                                                class="btn btn-sm btn-primary"
                                                title="Edit">Edit</a>
                                            <a href="#"
                                                class="btn btn-sm btn-danger"
                                                data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="destroy({{ $row->faq_id }})">Hapus</a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <p class="text-center">{{ $all_faq->isEmpty() ? 'NO DATA' : '' }}</p>
                            </div>
                        </div>
                        {{-- Pagination --}}
                        <div class="card-footer text-right">
                            {{ $all_faq->links() }}
                            @if ($all_faq['links'])
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    @foreach ($all_faq['links'] as $item)
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
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <form
                        class="needs-validation"
                        novalidate=""
                        id="formTambahFaq"
                        method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah FAQ Baru</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text"
                                        name="title"
                                        class="form-control"
                                        required>
                                    <div class="invalid-feedback">
                                        Isi judul
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                        <select class="form-control selectric" name="category">
                                            @foreach ($all_category as $item)  
                                            <option value="{{ $item->category_id }}" {{ isset($item->category_id) ? $item->name.' selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                            
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea name="content" id="summernote" class="summernote-simple"></textarea>
                                </div>
                            </div>
                            <div class="card-footer pt-0">
                                <button class="btn btn-primary" onclick="store()">Publikasi</button>
                            </div>
                        </div>
                    </form>
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
    <script src="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('stisla/library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
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

$(document).ready(function() {
        // Menghapus elemen .modal-backdrop
        $('.modal').on('shown.bs.modal', function() {
            $('.modal-backdrop').remove();
        });
    });

$('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['style']],
    ['insert', ['link']],
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['codeview', ['codeview']]
  ]
});
function store() {
  const form = document.getElementById('formTambahFaq');
  const formData = new FormData(form);

  fetch("{{ route('faq_admin_page.store') }}", {
    method: 'post',
    headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  },
  })
    .then(response => response.json())
    .then(data => {
          window.location.reload();
        iziToast.success({
        title: 'Success',
        message: data.message,
        position: 'topRight'
      });
        
    })
    .catch(error => {
        iziToast.error({
        title: 'Error',
        message: 'Eror'+error,
        position: 'topRight'
      });
        console.log(error);
    });
}

function destroy(id) {

  fetch("{{ url('faq_admin_page') }}/"+id, {
    method: 'post',
  })
    .then(response => response.json())
    .then(data => {
          window.location.reload();
        iziToast.success({
        title: 'Success',
        message: data.message,
        position: 'topRight'
      });
        
    })
    .catch(error => {
        iziToast.error({
        title: 'Error',
        message: 'Eror'+error,
        position: 'topRight'
      });
        console.log(error);
    });
}


// function read(id) {
//     $.get("{{ url('#') }}/" + id, {}, function(data, status) {
//         // jQuery.noConflict();
//         $("#exampleModalLabel").html('Detail Tiket ' + id)
//         $("#page").html(data);
//         $("#exampleModal").modal('show');
//     });
// }


// function updateBtn(id) {
//     var formData = new FormData($('#formTambahFaq')[0]);

//     $.ajax({
//     url: "{{ url('tiket/update_tiket_ditugaskan') }}/" + id,
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
//             iziToast.error({
//                 title: 'Error',
//                 message: response.message,
//                 position: 'topRight',
//             });
//         }
//     });
// }

// function store() {
//   fetch("")
//     .then(response => response.text())
//     .then(data => {
//       document.getElementById("exampleModalLabel").innerHTML = 'Tambah User';
//       document.getElementById("page").innerHTML = data;
//       $('#exampleModal').modal('show'); // Use jQuery to show the Bootstrap modal
//     })
//     .catch(error => {
//       console.error('Error:', error);
//     });
// }


    </script>
@endpush
