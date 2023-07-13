@extends('layouts.appresi')
@section('content')
    @push('style')
        <!-- CSS Libraries -->

    @endpush
    @include('sivitas_akademika.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Buat Tiket</h4>
                    </div>
                    {{--                    Alert Message Success --}}
                    <div class="alert alert-success alert-dismissible fade" role="alert" style="display: none; ">
                        <strong>Berhasil</strong> ID Tiket <a href="{{route('indexCekStatusTiket')}}" class="alert-link"><span id="ticket_id"></span></a> Silakan.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    {{--                    Alert Message Error --}}
                    <div class="alert alert-danger alert-dismissible fade" role="alert" style="display: none; ">
                        <span id="ticket_id"></span>
                        <strong>Gagal</strong> Silakan coba kembali .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form action="#" class="neeeds-validation" method="POST" enctype="multipart/form-data"
                            id="formTiket" novalidate>
                            <!-- start form -->
                            @csrf
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" id="inputEmail3">
                                    {{-- Error message --}}
                                    {{-- <span id="inputEmail3" class="error-message"></span> --}}
                                    <span class=" text-error text-danger email_error"></span>
                                    <div class="valid-feedback">
                                        Benar
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputKeluhan" class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="keluhan" class="form-control @error('keluhan') is-invalid @enderror" id="inputKeluhan">
                                    {{-- Message Validation --}}
                                    <span class="text-error text-danger keluhan_error"></span>
                                    <div class="valid-feedback">
                                        Benar</div>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Topik Bantuan</legend>
                                <div class="col-sm-10">
                                    @if (!empty($category) && count($category) > 0)
                                        @foreach ($category as $row)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori"
                                                    id="gridRadios1" value="{{ $row->category_id }}"
                                                    {{ old('kategori') == $row->category_id ? 'checked' : '' }} checked>
                                                <label class="form-check-label" for="gridRadios1">
                                                    {{ $row->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text text-muted">Tidak ada kategori yang tersedia.</p>
                                    @endif
                                    <span class="text-error text-danger kategori_error"></span>

                                    <div class="valid-feedback">
                                        Benar
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="inputLokasi" class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-lg-4 col-md-4">
                                    <select id="lokasi" name="lokasi" class="form-select @error('lokasi') is-invalid @enderror">
                                        <option selected disabled value="">Choose...</option>
                                        @if (!empty($locations) && count($locations) > 0)
                                            @foreach ($locations as $row)
                                                <option value="{{ $row->location_id }}"
                                                    {{ old('lokasi') == $row->location_id ? 'selected' : '' }}">
                                                    {{ $row->name }}</option>
                                            @endforeach
                                    </select>
                                        @else
                                    <p class="text text-muted">Tidak ada lokasi yang tersedia.</p>
                                        @endif
                                    {{-- Message Validation --}}
                                    <span class="text-error text-danger lokasi_error"></span>
                                    <div class="valid-feedback">
                                        Benar</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <textarea name="deskripsi" id="inputDeskripsi" cols="30" class="form-control" placeholder="..."></textarea>
                                    <div class="valid-feedback">
                                        Opsional</div>
                                </div>
                            </div>
                            <div class="container col-md-6 mb-3">
                                <div class="mb-5 text-center">
                                    <label for="formFile" class="form-label lead">Upload Gambar</label>
                                    <div id="imageContainer"></div>
                                    <button onclick="addImageInput(event)" id="addImageButton"
                                        class="btn btn-primary mt-3">Tambah Gambar</button>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                      <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1">
                          <label class="form-check-label" for="gridCheck1">
                            Example checkbox
                          </label>
                        </div>
                      </div>
                    </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="recaptcha-container">
                                            <div class="g-recaptcha mb-3" style="max-width: 300px;" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Message Validation --}}
                                <span class="text-error text-danger recaptcha_error"></span>
                            </div>
                            <button type="submit" onclick="store(event)" class="btn btn-primary" id="btnSubmit">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form> <!-- End form -->
                    </div>
                </div>
            </div>
            @include('sivitas_akademika.artikel_terkait')
        </div>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        // let imageCount = 0;

        function addImageInput(event) {
            event.preventDefault();
            const imageContainer = document.getElementById('imageContainer');
            const inputFile = document.createElement('input');
            const img = document.createElement('img'); //Create element img
            img.classList = 'container', img.id = 'imgPreview', img.setAttribute('src', ''); //Add another <img> attributes
            imageContainer.appendChild(img);
            inputFile.type = 'file';
            inputFile.name = 'filenames';
            inputFile.classList.add('form-control');
            inputFile.addEventListener('change', function() {
                readURL(this);
            });

            const deleteButton = document.createElement('button');
            deleteButton.innerHTML = 'Hapus';
            deleteButton.classList.add('btn', 'btn-danger', 'mt-1');
            deleteButton.onclick = function() {
                inputFile.remove();
                deleteButton.remove();
                deletePreview();
                showAddImageButton();
            };

            imageContainer.appendChild(inputFile);
            imageContainer.appendChild(deleteButton);

            hideAddImageButton();
        }

        function readURL(inputFile) {
            if (inputFile.files && inputFile.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgPreview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(inputFile.files[0]);
            }
        }

        // function preview(event) {
        //     const file = event.target.files[0];
        //     const reader = new FileReader();

        //     reader.onload = function(e) {
        //         const imageContainer = document.getElementById('imageContainer');
        //         const img = document.createElement('img');
        //         img.src = e.target.result;
        //         img.classList.add('img-fluid');
        //         imageContainer.insertBefore(img, imageContainer.firstChild);
        //     };

        //     reader.readAsDataURL(file);
        // }

        function deletePreview() {
            const imageContainer = document.getElementById('imageContainer');
            const images = imageContainer.getElementsByTagName('img');
            while (images.length > 0) {
                imageContainer.removeChild(images[0]);
            }
        }

        function hideAddImageButton() {
            const addImageButton = document.getElementById('addImageButton');
            addImageButton.style.display = 'none';
        }

        function showAddImageButton() {
            const addImageButton = document.getElementById('addImageButton');
            addImageButton.style.display = ''; //keep display as it was.
        }

        function store(event){
            event.preventDefault()

            var formData = new FormData($('#formTiket')[0]);
                $.ajax({
                    url: "{{ url('tickets/store') }}",
                    type: 'post',
                    data: formData,
                    datatype: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#formTiket').find("span.text-error").text("");
                    },
                    success: function(response) {
                        console.log(response);
                        const { data, message, url } = response
                        const {ticket_number} = data
                        $('#formTiket')[0].reset();
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
                            // console.log(prefix,val);
                            $("span."+prefix+"_error").text(val[0]);
                        })
                        swal({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan saat mengirim data: " + error,
                            button: true
                        }).then((result) => {
                            if (result) {
                                $("#ticket_id").text('ticket_number');
                                $("div.alert.alert.alert-danger").addClass('show').show();
                        //     window.location.href = "{{ url('tickets') }}";

                            }
                        });
                    }
            });
        }
        // $(document).ready(function() {
        //     $('#btnSubmit').submit(function(event) {
        //         event.preventDefault();

        //         var formData = new FormData($('#formTiket')[0]);
        //         $.ajax({
        //             url: "{{ url('tickets/store') }}",
        //             type: 'POST',
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function(response) {
        //                 console.log(response);
        //                 Swal.fire({
        //                     icon: "success",
        //                     title: "Berhasil",
        //                     text: "Data berhasil dikirim",
        //                     showConfirmButton: true
        //                 });
        //             },
        //             error: function(xhr, status, error) {
        //                 console.log(xhr.responseText);
        //                 Swal.fire({
        //                     icon: "error",
        //                     title: "Gagal",
        //                     text: "Terjadi kesalahan saat mengirim data: " + error,
        //                     showConfirmButton: true
        //                 });
        //             }
        //         });
        //     });
        // });
        /*function store() {
            // Mendapatkan data form
            var form = $('formTiket')[0];
            var formData = new FormData(form);
            $.ajax({
                url: '{{ url('tickets.store') }}', // Ganti dengan URL tujuan pengiriman form
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Menampilkan SweetAlert respons berhasil
                    Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Data berhasil dikirim",
                    showConfirmButton: true
                    });
                },
                error: function(xhr, status, error) {
                    // Menampilkan SweetAlert respons gagal
                    Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Terjadi kesalahan saat mengirim data: " + error,
                    showConfirmButton: true
                    });
                }
                });
        } */
    </script>
    <script>
        // Tambahkan event listener untuk menangani submit form
        document.getElementById('formTiket').addEventListener('submit', function(event) {
            if (!event.target.checkValidity()) {
                // Jika form tidak valid, hentikan pengiriman form dan tampilkan pesan error
                event.preventDefault();
                event.stopPropagation();
            }

            // Tambahkan class "was-validated" untuk menunjukkan bahwa form telah divalidasi
            event.target.classList.add('was-validated');
        });
    </script>
    <!-- JavaScript code to copy the text to the clipboard -->
    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("ticket_id");
            var textArea = document.createElement("textarea");
            textArea.value = copy   Text.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
            alert("Text copied to clipboard");
        }
    </script>
@endpush
