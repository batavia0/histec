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
                                    <h5 class="card-title">Cek Status Tiket</h5>
                                        <div class="col mb-3 mt-3">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                                                <input type="search" class="form-control" name="search_id_tiket" id="id_ticket" placeholder="Masukkan ID Tiket">
                                            </div>
                                        </div>
                                        <h5 class="card-title">Histori Tiket</h5>
                                        <div class="col mt-3">
                                            <div class="portfolio-info ticket-searchbar" id="histori-tiket">

                                            </div>
                                        </div>
                                </div>
                            </div>
<!--
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
                                </div>
                            </div> -->
<!--                            <div class="card mt-4">
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
                                    </div>
                                </div>
                            </div>


                        </div> -->
                          <!-- <div class="portfolio-description">
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
                                </div>
                            </div> -->
                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                
                            </div>
                            <div class="portfolio-info ticket-searchbar" id="histori-tiket2">

                            </div>
                    </div>

                </div>
            </section><!-- End Portfolio Details Section -->
            
@endsection

@push('scripts')
    <!-- JS Libraies -->
    
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

    <script>
        $(document).ready(function(){
            $('#id_ticket').on('keyup',function(){
                var value = $(this).val();
                $.ajax({
                    type:"get",
                    url: "{{ url('cek_status_tiket/find_tickets') }}",
                    data: {'search_id_tiket':value},
                    success: function (data) {
                        // console.log(JSON.stringify(data));
                    $('.ticket-searchbar').html(data.data.output);
                    $('#histori-tiket').html(data.data.output2);

                    // Mendapatkan semua elemen dengan kelas "userDateTime"
                    var userDateTimeElements = document.getElementsByClassName("userDateTime");

                    // Memformat tanggal untuk setiap elemen
                    for (var i = 0; i < userDateTimeElements.length; i++) {
                        var dateTimeString = userDateTimeElements[i].textContent.trim();
                        var formattedDateTime = dateTimeString === '--|--' ? dateTimeString : formatDateTime(dateTimeString);
                        userDateTimeElements[i].textContent = formattedDateTime;
                    }
                    },
                    error: function(xhr,error){
                        alert("Ada kesalahan " + error);
                    }
                });
            })
        });
    </script>
@endpush
