@extends('layouts.appstisla')

@section('title', 'Berita Penyelesaian')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}"> --}}
        <link rel="stylesheet"
        href="{{ asset('stisla/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
        <link rel="stylesheet"
        href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Berita Penyelesaian</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('berita_penyelesaian.index') }}">Berita Penyelesaian</a></div>
                    <div class="breadcrumb-item">Buat Berita Penyelesaian</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Berita Penyelesaian</h4>
                            <div class="card-header-form">
                                <form>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('berita_penyelesaian/generate') }}" method="post" id="formBeritaPenyelesaian">
                                @csrf
                                <div class="form-group">
                                    <label>Nomor Surat</label>
                                    <input type="text"
                                        class="form-control"
                                        name="nomor_surat"
                                        placeholder="contoh: '1057/PL41.AI/TU.00.01/2023'"
                                        value="{{ old('nomor_surat') }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text"
                                        class="form-control datepicker"
                                        name="date"
                                        value="{{ old('date') }}">
                                </div>
                                <div class="form-group">
                                    <label>Kegiatan</label>
                                    <input type="text"
                                        class="form-control"
                                        name="kegiatan"
                                        placeholder="contoh: 'aktivasi jaringan internet lantai 2'"
                                        value="{{ old('kegiatan') }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Perihal</label>
                                            <input type="text"
                                                class="form-control"
                                                name="perihal"
                                                placeholder="contoh: 'Permohonan Pengaktifan WiFi'"
                                                value="{{ old('perihal') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Ruangan</label>
                                            <input type="text"
                                                class="form-control"
                                                name="ruangan"
                                                placeholder="contoh: 'Ruang Teori 1'"
                                                value="{{ old('ruangan') }}">
                                        </div>
                                    </div>
                                </div>
                                    <label>Keterangan</label>
                                    <textarea class="form-control"
                                    data-height="150"
                                    name="keterangan"
                                    placeholder="contoh: 'Adapun SSID yang dilakukan diaktifikan.'"
                                    value="{{ old('keterangan') }}"></textarea>

                                    <label>Keterangan Tambahan</label>
                                    <textarea class="form-control"
                                    data-height="150"
                                    name="keterangan_tambahan"
                                    placeholder="contoh: 'Dengan password 123 '"
                                    value="{{ old('keterangan_tambahan') }}"></textarea>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label>Nama Gedung</label>
                                        <input type="text"
                                            class="form-control"
                                            name="gedung"
                                            placeholder="contoh 'Agroindustri'"
                                            value="{{ old('gedung') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Institusi</label>
                                            <input type="text"
                                            class="form-control"
                                            name="institusi"
                                            value="Politeknik Negeri Subang"
                                            value="{{ old('institusi') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kota</label>
                                            <input type="text"
                                            class="form-control"
                                            name="kota"
                                            value="Subang">
                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="text"
                                                class="form-control"
                                                name="jabatan1"
                                                placeholder="contoh 'Wakil Direktur II'"
                                                value="{{ old('jabatan2') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text"
                                                class="form-control"
                                                name="jabatan2"
                                                value="Kepala UPT Teknologi Komunikasi dan Informasi">   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="text"
                                                class="form-control"
                                                name="nama_gelar1"
                                                placeholder="contoh 'Nama dan gelar 1'"
                                                value="{{ old('nama_gelar1') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text"
                                                class="form-control"
                                                name="nama_gelar2"
                                                placeholder="Nama dan gelar 2"
                                                value="{{ old('nama_gelar2') }}">   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="text"
                                                class="form-control"
                                                name="nip1"
                                                value="NIP.1">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text"
                                                class="form-control"
                                                name="nip2"
                                                value="NIP.2">   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="format">Format</label>
                                            <select name="format" id="format" class="form-control">
                                                <option value="pdf">PDF</option>
                                                <option value="docx">DOCX</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-lg" type="submit">GENERATE</button>
                                    </div>
                                </div>
                                
                            </form>
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
     <script src="{{ asset('stisla/library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('stisla/library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('stisla/library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('stisla/library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('stisla/js/page/forms-advanced-forms.js') }}"></script>

    <script>
        $.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
     </script>

<script>
    function generate() {
    var formData = new FormData($('#formBeritaPenyelesaian')[0]);

    $.ajax({
        url: "{{ url('berita_penyelesaian/generate') }}",
        type: 'get',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // if (response.success) {
            window.location.href = response.url;
            // window.location.href = response.file;
            // }
            // $('#exampleModal').modal('hide');
            // window.location.reload()
            // iziToast.success({
            //     title: 'Success',
            //     message: response.message,
            //     position: 'topRight',
            //});
            // console.log(response.data);
        },
        error: function(xhr, status, error) {
            console.log(xhr,error);
        }
    });
}
</script>
@endpush
