@extends('layouts.appstisla')

@section('title', 'Balasan Tiket')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/chocolat/dist/css/chocolat.css') }}">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
                <h1>Balasan Tiket</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Balasan Tiket</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tiket Selesai</h4>
                            </div>
                            <div class="card-body">
                                <a href="#"
                                    class="btn btn-primary btn-icon icon-left btn-lg btn-block d-md-none mb-4"
                                    data-toggle-slide="#ticket-items">
                                    <i class="fas fa-list"></i> Tiket Selesai
                                </a>
                                <div class="tickets">
                                    <div class="ticket-items"
                                        id="ticket-items">
                                        @foreach ($all_finished_tickets_filtered as $item) 
                                        <div class="ticket-item" onclick="show({{ $item->ticket_id }})">
                                            <div class="ticket-title">
                                                <h4>{{ $item->name }}</h4>
                                            </div>
                                            <div class="ticket-desc d-inline-block">
                                                <div>{{ $item->email }}</div>
                                                <div id="ticket_id" class="ticket_no">{{ $item->ticket_no }}<span><button class="btn btn-sm"><i class="far fa-copy" id="icon_clip" onclick="copyToClipboard(this)"></i></button></span>
                                                </div>
                                                <div>{{ $item->description }}</div>
                                            </div>
                                            <div class="bullet"></div>
                                            <div class="userDateTime">
                                                {{ $item->ticket_finished_at ?? '--|--' }}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="ticket-content" id="page">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('stisla/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('stisla/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('stisla/library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>

    <script>
        function copyToClipboard(iconElement) {
    var ticketNumberElement = iconElement.closest(".ticket_no"); // Find the closest ancestor with class "ticket_no"
    var ticketNumber = ticketNumberElement.textContent.trim(); // Get the text content of the element and remove leading/trailing whitespace

    // Create a temporary textarea element and set its value to the ticket number
    var textArea = document.createElement("textarea");
    textArea.value = ticketNumber;
    document.body.appendChild(textArea);
    // Select and copy the content from the textarea
    textArea.select();
    document.execCommand("Copy");

    // Remove the temporary textarea
    textArea.remove();

    // Show the success message
    alert("Nomor Tiket berhasil disalin: " + ticketNumber);
}

function show(id) {
    $.get("{{ url('balasan_tiket') }}/" + id, {}, function (data, status) {
        $("#page").html(data);
        var imageSrc = $('.gallery-item').attr('data-image');
        $('.gallery-item').attr('data-image', imageSrc);
        $('.summernote').summernote({
            height: 200,
        });
        // Get the ticket_finished_at data from the #userDateTime div
        var ticketFinishedAt = document.getElementById("userDateTime").textContent.trim();

        // Format and update the ticketFinishedAt div content
        var formattedDateTime = formatDateTime(ticketFinishedAt);
        document.getElementById("userDateTime").textContent = formattedDateTime;
    });
    // Mendapatkan semua elemen dengan kelas "ticket-item"
    var ticketItemElements = document.getElementsByClassName("ticket-item");

    // Menambahkan event listener untuk setiap elemen
    for (var i = 0; i < ticketItemElements.length; i++) {
        ticketItemElements[i].addEventListener("click", function () {
            // Menghapus kelas "active" dari semua elemen
            for (var j = 0; j < ticketItemElements.length; j++) {
                ticketItemElements[j].classList.remove("active");
            }
            // Menambahkan kelas "active" pada elemen yang dipilih
            this.classList.add("active");
        });
    }
}

function copyText(element) {
    // Create a temporary input element
    var tempInput = document.createElement("textarea");
    // Set the value of the input element to the text content of the clicked element
    tempInput.value = element.textContent;    
    // Append the input element to the document body
    document.body.appendChild(tempInput);
    
    // Select the text in the input element
    tempInput.select();
    
    // Copy the selected text to the clipboard
    document.execCommand("copy");
    
    // Remove the temporary input element from the document body
    document.body.removeChild(tempInput);

    alert(tempInput.value+' Disalin')
}

function sendMail(email) {
  var formData = new FormData($('#formReply')[0]);
  fetch("{{ url('balasan_tiket/send_mail') }}/" + email, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: formData
  })
    .then(response => {
      if (response.ok) {
        $('#exampleModal').modal('hide');
        window.location.reload();
        iziToast.success({
          title: 'Success',
          message: 'Berhasil Mengirim Email',
          position: 'topRight',
        });
      } else {
        throw new Error('Error');
      }
    })
    .catch(error => {
      iziToast.error({
        title: 'Error',
        message: error.message,
        position: 'topRight',
      });
    });
}
    </script>
@endpush
