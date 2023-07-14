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
        '<p class="text text-muted">' + faq.category.name + '</p>';

    faqPage += faqItem;
});
$('#faqPage').append(faqPage);
  </script>
@endpush
