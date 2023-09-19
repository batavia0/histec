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
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="col mb-3 mt-3">
            <div class="input-group">
              <div class="input-group-text"><i class="fas fa-search"></i></div>
              <input type="search" class="form-control form-control-lg" name="search_id_tiket" id="searchInput" placeholder="Cari bantuan">
            </div>
          </div>
          <div class="row">
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
var all_faq = @json($all_faq);

// Function untuk mengupdate daftar FAQ
function updateFAQList() {
    var searchText = $('#searchInput').val().toLowerCase();

    // Filter FAQ berdasarkan teks pencarian
    var filteredFAQ = all_faq.filter(function(faq) {
        return faq.title.toLowerCase().includes(searchText) || faq.answer.toLowerCase().includes(searchText);
    });

    // Clear daftar FAQ saat ini
    $('#faq-list').empty();

    // Tampilkan daftar FAQ yang sesuai
    filteredFAQ.forEach(function(faq) {
        var cardItem = '<div class="col mx-auto py-2">' + '<div class="card-body">' +
          '<h5 class="card-title"><a href="{{url('faq')}}/' + faq.faq_id + '">' + faq.title + ' <i class="fas fa-external-link-square-alt"></i></a></h5>' +
            '<h6 class="card-subtitle mb-2 text-body-secondary">Kategori: ' + faq.category.name + '</h6>' +
            '<div class="card-text overflow-auto" style="max-height: 200px;">' + faq.answer + 
            '</div>' + '</div>';
        $('#faq-list').append(cardItem);
    });
}

// Event listener untuk keyup event pada input pencarian
$('#searchInput').on('keyup', function() {
    updateFAQList();
});

// Inisialisasi tampilan awal dengan menampilkan semua FAQ
updateFAQList();
  </script>
@endpush
