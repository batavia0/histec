@extends('layouts.appresi')
@section('content')
    @push('style')
        <!-- CSS Libraries -->
    @endpush
    @include('sivitas_akademika.navbar')
    <section>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row mt-5 col-md-8">
                <div class="col-lg-12 col-md-12">
                    <div class="hero-section">
                        <form id="searchForm">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" id="searchInput"
                                    placeholder="Cari FAQ Jawaban Masalah">
                            </div>
                        </form>

                        <div class="list-group" id="previewList">
                            <!-- List group items will be dynamically added here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Buat Tiket</h4>
                        </div>
                        {{-- Alert Message Success --}}
                        <div class="alert alert-success alert-dismissible fade" role="alert" style="display: none; ">
                            <strong>Berhasil</strong> ID Tiket <a href="{{ route('indexCekStatusTiket') }}"
                                class="alert-link"><span id="ticket_id"></span></a> <i
                                class="text text-link fas fa-paperclip" id="icon_clip" onclick="copyToClipboard()"></i>
                            Silakan cek status tiket anda.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="alert alert-success alert-dismissible fade" role="alert" style="display: none; ">
                            <strong>Silakan cek Email anda</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        {{-- Alert Message Error --}}
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email<span
                                            class="text text-danger">*</span>
                                    </label>
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
                                    <label for="inputKeluhan" class="col-sm-2 col-form-label">Keluhan<span
                                            class="text text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="keluhan"
                                            class="form-control @error('keluhan') is-invalid @enderror" id="inputKeluhan">
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
                                    <label for="inputLokasi" class="col-sm-2 col-form-label">Lokasi<span
                                            class="text text-danger">*</span></label>
                                    <div class="col-lg-4 col-md-4">
                                        <select id="lokasi" name="lokasi"
                                            class="form-select @error('lokasi') is-invalid @enderror">
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
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi<span
                                        class="text text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea name="deskripsi" id="inputDeskripsi" cols="30" class="form-control" placeholder="..."></textarea>
                                        <span class="text-error text-danger deskripsi_error"></span>
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
                                                <div class="g-recaptcha mb-3" style="max-width: 300px;"
                                                    data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Message Validation --}}
                                        <span class="text-error text-danger g-recaptcha-response_error"></span>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                                <button type="reset" id="btnReset" class="btn btn-danger">Reset</button>
                            </form> <!-- End form -->
                        </div>
                    </div>
                </div>
                {{-- @include('sivitas_akademika.artikel_terkait') --}}
            </div>
        </div>
    </section>
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

        document.getElementById('formTiket').addEventListener('submit', function(event) {
            event.preventDefault();
            $("#btnSubmit").prop("disabled", true);
            $("#btnReset").prop("disabled", true);

            // change button with spinner
            $("#btnSubmit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            store();
        });
        function store() {
            var formData = new FormData($('#formTiket')[0]);
            $.ajax({
                url: "{{ url('tickets/store') }}",
                type: 'post',
                data: formData,
                datatype: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#formTiket').find("span.text-error").text("");
                },
                success: function(response) {
                    console.log(response);
                    const {
                        data,message,url
                    } = response
                    const {
                        ticket_number
                    } = data
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
                    $("#btnSubmit").prop("disabled", false);
                    $("#btnReset").prop("disabled", true);
                    $("#btnSubmit").html("Submit");
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, (prefix, val) => {
                        // console.log(prefix,val);
                        $("span." + prefix + "_error").text(val[0]);
                        grecaptcha.reset();

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
                    $("#btnSubmit").prop("disabled", false);
                    $("#btnReset").prop("disabled", false);
                    $("#btnSubmit").html("Submit");
                }
            });
        }
    </script>
    <script>
        // // Tambahkan event listener untuk menangani submit form
        // document.getElementById('formTiket').addEventListener('submit', function(event) {
        //     if (!event.target.checkValidity()) {
        //         // Jika form tidak valid, hentikan pengiriman form dan tampilkan pesan error
        //         event.preventDefault();
        //         event.stopPropagation();
        //     }

        //     // Tambahkan class "was-validated" untuk menunjukkan bahwa form telah divalidasi
        //     event.target.classList.add('was-validated');
        // });
    </script>
    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("ticket_id");
            var copyIcon = document.getElementById("icon_clip");
            var textArea = document.createElement("textarea");
            textArea.value = copyText.textContent;
            copyIcon = textArea.value;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
            alert("Nomor Tiket berhasil disalin");
        }
    </script>
    <script>
        // Function to update the list group FAQ's based on search input
        function updatePreviewList() {
            var all_faq = @json($all_faq);
            var searchInput = $('#searchInput').val();

            // Clear the existing list
            $('#previewList').empty();

            if (searchInput === '') {
                return; // Exit the function early if search input is empty
            }

            // Filter the FAQ data based on the search input
            var filtered_faq = all_faq.filter(function(faq_obj) {
                var titleMatch = faq_obj.title.toLowerCase().includes(searchInput.toLowerCase());
                var categoryMatch = faq_obj.category.name.toLowerCase().includes(searchInput.toLowerCase());
                var answerMatch = faq_obj.answer.toLowerCase().includes(searchInput.toLowerCase());
                return titleMatch || categoryMatch || answerMatch;
                // return faq_obj.title.toLowerCase().includes(searchInput.toLowerCase());
            });

            // Generate the list items based on the filtered FAQ data
            filtered_faq.forEach(function(faq) {
                var listItem = '<a href="{{ url('faq') }}/' + faq.faq_id +
                    '"  class="list-group-item list-group-item-action" style="max-height: 200px; overflow: hidden;">' +
                    '<h5 class="mb-1">' + faq.title + '</h5>' +
                    '<p class="mb-1">' + faq.answer + '</p>' +
                    '<p class="text text-muted">' + faq.category.name + '</p>' +
                    '</a>';

                $('#previewList').append(listItem);
            });


            // Add event listener for hover effect
            $('#previewList').on('mouseenter', '.list-group-item', function() {
                $(this).addClass('list-group-item-primary');
            });

            $('#previewList').on('mouseleave', '.list-group-item', function() {
                $(this).removeClass('list-group-item-primary');
            });
        }

        // Event listener for keyup event on search input
        $('#searchInput').on('keyup', function() {
            updatePreviewList();
        });
    </script>
@endpush
