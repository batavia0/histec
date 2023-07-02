@extends('layouts.appresi')
@section('content')
    @push('style')
        <!-- CSS Libraries -->
    @endpush
    @include('sivitas_akademika.navbar')
{{--    <div class="container">--}}
{{--        <div class="row mt-5">--}}
{{--            <div class="col col-lg-6 border border-primary">--}}
{{--                <p class="text display-6 border border-primary">Disini halaman untuk mengecek status tiket</p>--}}
{{--            </div>--}}
{{--            <div class="col col-lg-4 border-primary">--}}
{{--                <p class="text display-6 border border-primary">The col-lg-4</p>--}}
{{--                <div class="row border border-primary">--}}
{{--                    <div class="col col-lg-8">--}}
{{--                        <h6>The col-lg-8 inside row</h6>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row mt-5">--}}
{{--            <div class="col col-lg-6 border border-primary d-flex justify-content-center">--}}
{{--                <p class="text display-6 border border-primary" style="overflow: auto;">sadsa</p>--}}
{{--            </div>--}}
{{--            <div class="col col-lg-4 border-primary">--}}
{{--                <p class="text display-6 border border-primary">Disini halaman untuk mengecek status tiket</p>--}}
{{--                    <div class="col col-lg-12 border border-primary">--}}
{{--                        <h6>Disini halaman unutk mengecek status tiket</h6>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="container border border-danger">--}}
{{--        <div class="row gy-4 mt-5 border border-primary justify-content-center">--}}
{{--            <div class="col col-md-8">--}}
{{--                <div class="card">--}}

{{--                <div class="card-header">--}}
{{--                    <h4>HEader</h4>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <p>Some text here</p>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
            <section id="portfolio-details" class="portfolio-details">
                <div class="container">

                    <div class="row gy-4">

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Cek Status ID Tiket</h5>
                                   {{-- Alert Message Error --}}
                    <div class="alert alert-danger alert-dismissible fade" role="alert" style="display: none; ">
                        <strong>Gagal</strong> <span id="ticket_id"></span> silakan coba kembali .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    {{-- Alert Message success --}}
                    <div class="alert alert-success alert-dismissible fade" role="alert" style="display: none; ">
                        <strong>Berhasil</strong> <span id="ticket_id"></span>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                                        <div class="row row-mb-3">
                                            <form action="#" action="get" id="formIdTiket">
                                                @csrf
                                            <label for="id-tiket" class="form-label">ID Tiket</label>
                                            <input type="text" class="form-control" name="id_ticket" id="id_ticket" placeholder="Masukkan ID Tiket">
                                            <span class="text-error text-danger id_ticket_error"></span>

                                        <button type="submit" onclick="read(event)" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Riwayat Penanganan</h5>
                                    <div class="accordion" id="riwayat-penanganan-accordion">
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="heading1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                    Detail Penanganan 1
                                                </button>
                                            </h3>
                                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#riwayat-penanganan-accordion">
                                                <div class="accordion-body">
                                                    Isi dari Detail Penanganan 1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="heading2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                    Detail Penanganan 2
                                                </button>
                                            </h3>
                                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#riwayat-penanganan-accordion">
                                                <div class="accordion-body">
                                                    Isi dari Detail Penanganan 2
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tambahkan accordion-item lain sesuai kebutuhan -->
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">FAQ</h5>
                                    <div class="accordion" id="faq-accordion">
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="faq-heading1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse1" aria-expanded="false" aria-controls="faq-collapse1">
                                                    Pertanyaan 1
                                                </button>
                                            </h3>
                                            <div id="faq-collapse1" class="accordion-collapse collapse" aria-labelledby="faq-heading1" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    Jawaban untuk pertanyaan 1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="faq-heading2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse2" aria-expanded="false" aria-controls="faq-collapse2">
                                                    Pertanyaan 2
                                                </button>
                                            </h3>
                                            <div id="faq-collapse2" class="accordion-collapse collapse" aria-labelledby="faq-heading2" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    Jawaban untuk pertanyaan 2
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tambahkan accordion-item lain sesuai kebutuhan -->
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-4">
                            <div class="portfolio-info">
                                <h3>Informasi Tiket</h3>
                                <ul>
                                    <li><strong>Klien</strong>: bramas*****.com</li>
                                    <li><strong>ID Tiket</strong>: 168301289320909401</li>
                                    <li><strong>Tiket Dibuat</strong>: 01 Juni, 2023 23:59</li>
                                    <li><strong>Status</strong>: Closed</li>
                                    <li><strong>Tiket Selesai</strong>: 02 Juni, 2023 00:00</li>
                                </ul>
                            </div>
                            <div class="portfolio-description">
                                <h2>Riwayat Penanganan</h2>
                                <div class="accordion" id="riwayat-penanganan-accordion">
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="heading1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                Detail Penanganan 1
                                            </button>
                                        </h3>
                                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#riwayat-penanganan-accordion">
                                            <div class="accordion-body">
                                                Isi dari Detail Penanganan 1
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="heading2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                Detail Penanganan 2
                                            </button>
                                        </h3>
                                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#riwayat-penanganan-accordion">
                                            <div class="accordion-body">
                                                Isi dari Detail Penanganan 2
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tambahkan accordion-item lain sesuai kebutuhan -->
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section><!-- End Portfolio Details Section -->
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        function read(event){
            event.preventDefault()

            var formData = new FormData($('#formIdTiket')[0]);
            $.ajax({
                url: "{{ url('cek_status_tiket/find_tickets') }}",
                type: 'get',
                data: formData,
                datatype: 'json',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#formTiket').find("span.text-error").text("");
                },
                success: function(response) {
                    const { data, message, url } = response
                    console.log(response);
                    const {ticket_number} = data
                    $('#formIdTiket')[0].reset();
                    // console.log(data, message, url)
                    swal({
                        icon: "success",
                        title: "Berhasil",
                        text: "Data berhasil dikirim",
                        button: true
                    }).then((result) => {
                        if (result) {
                            // Send alert
                            $("#ticket_id").text(ticket_number);
                            $("div.alert.alert.alert-success").addClass('show').show();
                            // window.location.href = "{{ url('tickets') }}";
                        }
                    });
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors,(prefix,val) => {
                        console.log(prefix,val);
                        // console.log(data);
                        $("span."+prefix+"_error").text(val[0]);
                    })
                    swal({
                        icon: "error",
                        title: "Gagal",
                        text: "Terjadi kesalahan saat mengirim data: " + error,
                        button: true
                    }).then((result) => {
                        if (result) {
                            $("#ticket_id").text('Tidak ditemukan');
                            $("div.alert.alert.alert-danger").addClass('show').show();
                            //     window.location.href = "{{ url('tickets') }}";

                        }
                    });
                }
            });
        }

    </script>
@endpush
