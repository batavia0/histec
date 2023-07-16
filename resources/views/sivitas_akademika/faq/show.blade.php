@extends('layouts.appresi')
@section('content')
@push('style')
        <!-- CSS Libraries -->

@endpush
@include('sivitas_akademika.navbar')
<main id="main">
      <div class="container">
        <div class="section-title mt-5">
            <h2>FAQ</h2>
          </div>
      </div>
</main>
<div class="container">
  <div class="row mt-5 col-md-12">
    <div class="col md-12 mb-3">
      <form id="searchForm">
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" id="searchInput" placeholder="Cari FAQ Jawaban Masalah">
        </div>
    </form>

    <div class="list-group" id="previewList">
        <!-- List group items will be dynamically added here -->
    </div>
    </div>
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="col mb-3 mt-3">
          </div>
          <div class="row">
            <div class="col-lg-12" id="faqPage">

            </div>
            {{-- <div class="col-md-4 -flex justify-content-end mb-2">
              <label for="filterBy">Filter By:</label>
              <select id="filterBy" class="form-select ms-2">
                <option value="all">All</option>
                <option value="category1">Jaringan Internet</option>
                <option value="category2">Software</option>
                <option value="category3">Hardware</option>
              </select>
            </div> --}}
            <div class="col mx-auto py-2">
              <div id="faq-list">
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>

  </div>
</div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/sweetalert/dist/sweetalert.min.js') }}"></script>
  <script>
var detail_faq = @json($detail_faq);
// Buat variabel untuk menyimpan HTML yang akan ditambahkan ke #previewList
var faqPage = '';

// Loop melalui data $detail_faq dan tambahkan ke variabel faqPage
detail_faq.forEach(function(faq) {
    var faqItem = '<h5 class="mb-1">' + faq.title + '</h5>' +
        '<p class="mb-1 overflow-scroll" style="max-height: 500px;">' + faq.answer + '</p>' +
        '<p class="text text-muted">' + faq.category.name + '</p>' +
        '<div class="d-flex justify-content-end">' +
        '<div class="btn-group" role+"group" aria-label="User next decision">' +
          '<p class="text-secondary">' +
          '<a href="{{ route('tickets.index') }}" class="text-secondary">Kembali buat tiket</a></p>' +
          '</div>' +
          '</div>';
    faqPage += faqItem;
});
$('#faqPage').append(faqPage);

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
        var listItem = '<a href="{{ url("faq") }}/' + faq.faq_id + '"  class="list-group-item list-group-item-action">' +
            '<h5 class="mb-1">' + faq.title + '</h5>' +
            '<p class="mb-1 overflow-hidden" style="max-height: 200px;">' + faq.answer + '</p>' +
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
