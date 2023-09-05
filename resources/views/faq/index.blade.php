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
                                        <td>{{ $row->category->name }}</td>
                                        <td>{{ $row->users->name }} | {{ $row->users->email }}</td>
                                        <td class="userDateTime">{{ $row->created_at }}</td>
                                        <td><a href="#"
                                                class="btn btn-sm btn-outline-primary"
                                                onclick="read({{ $row->faq_id }})">Detail</a>
                                            <a href="#"
                                                class="btn btn-sm btn-primary"
                                                title="Edit"
                                                onclick="edit({{ $row->faq_id }})">Edit</a>
                                            <a href="#"
                                                class="btn btn-sm btn-danger"
                                                data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="deleteConfirmFAQ({{ $row->faq_id }})">Hapus</a>
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
            <div id="pageShow"></div>
            <div id="pageEdit"></div>
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
                                    <textarea name="content" id="summernote" class="summernote-simple"
                                    required></textarea>
                                </div>
                                <div class="invalid-feedback">
                                    Isi Konten
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

  fetch("{{ url('faq_admin_page/store') }}", {
    method: 'post',
    headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  },
  body: formData
  })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            window.location.reload();
        iziToast.success({
        title: 'Success',
        message: data.message,
        position: 'topRight'
      });
        }   
    })
    .catch(error => {
        iziToast.error({
        title: 'Error',
        message: 'Eror'+error,
        position: 'topRight'
      });
        // console.log(error);
    });
}

function updateBtn(id) {
    var formData = new FormData($('#formEditFaq')[0]);
  fetch("{{ url('faq_admin_page/update') }}/" + id, {
    method: 'POST',
    headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  },
  body: formData
  })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            window.location.reload();
        iziToast.success({
        title: 'Success',
        message: data.message,
        position: 'topRight'
      });
        }
        else{
            iziToast.info({
        title: 'Info',
        message: data.message,
        position: 'topRight'
      });

        }   
    })
    .catch(error => {
    iziToast.error({
        title: 'Error',
        message: 'Error '+error,
        position: 'topRight'
    });
    window.location.reload();
});
}

function edit(id) {
    // document.getElementById("detailShow").style.display = "none";
    $.get("{{ url('faq_admin_page/edit') }}/" + id, {}, function(data, status) {
        $("#label").html('Edit FAQ ' + id);
        $("#pageEdit").html(data);
        // Scroll to the formEditFaq element
        $('html, body').animate({
            scrollTop: $("#formEditFaq").offset().top
        }, 500);
        $('#summernote').summernote();
    });
}

function destroy(id) {

  fetch("{{ url('faq_admin_page/destroy') }}/"+id, {
    method: 'post',
    headers: {
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
    });
}

function read(id) {
    $.get("{{ url('faq_admin_page/show') }}/" + id, {}, function(data, status) {
        // jQuery.noConflict();
        $("#label2").html('Detail' + id)
        $("#pageShow").html(data);
        $('html, body').animate({
            scrollTop: $("#detailShow").offset().top
        }, 500);
        $('#summernote').summernote();
    });
}

function deleteConfirmFAQ(id) {
    swal({
        title: 'Apakah Anda Yakin?',
        text: "Anda Ingin Menghapus FAQ?",
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then((result) => {
        if (result) {
            destroy(id)
            swal({
                title: 'Terhapus',
                text: "Berhasil menghapus FAQ",
                type: 'success'
            })
        }
    })
}
    </script>
@endpush
