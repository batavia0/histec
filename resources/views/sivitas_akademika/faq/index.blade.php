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
              <input type="search" class="form-control form-control-lg" name="search_id_tiket" id="id_ticket" placeholder="Cari bantuan">
            </div>
          </div>
          <div class="col-lg-12 d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                      Jaringan Internet
                    </button>
                  </h2>
                  <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                      jaringan internetn adalah
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                      Hardware
                    </button>
                  </h2>
                  <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                      Pada hardware anda merupakan
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse2">
                      Software
                    </button>
                  </h2>
                  <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                      Software merupakan
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="faq-list">

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
      // Function to update the list group based on search input
      function updatePreviewList() {
          var searchInput = $('#searchInput').val();
          // Perform API call or fetch data  
          if (searchInput === '') {
          $('#previewList').empty();
          return; // Exit the function early
      }
          var all_faq = @json($all_faq)
          // Clear the existing list
          $('#previewList').empty();
  
  
          // Generate the list items based on the fetched data
          for (var i = 0; i < articleList.length; i++) {
              var listItem = '<a href="#" class="list-group-item list-group-item-action">' +
                  '<h5 class="mb-1">' + articleList[i].title + '</h5>' +
                  '<p class="mb-1">' + articleList[i].content + '</p>' +
                  '</a>';
  
              $('#previewList').append(listItem);
          }
  
          // Tambahkan event listener untuk menambahkan kelas pada hover
          $('#previewList').on('mouseenter', '.list-group-item', function() {
              $(this).addClass('list-group-item-primary');
          });
  
          $('#previewList').on('mouseleave', '.list-group-item', function() {
              $(this).removeClass('list-group-item-primary');
          });
          
      }
  
      // Event listener for keyup event on search input
      $('#searchInput').on('keyup', function () {
          updatePreviewList();
      });
  </script>
  <script>
    // Perform API call or fetch data 
  var all_faq = @json($all_faq);
  // Generate the list items based on the fetched data
  $('#faq-list').empty();
  for (var i = 0; i < all_faq.length; i++) {
              var cardItem = '<div class="col mx-auto py-2">'+'<div class="card-body">'+
                    '<h5 class="card-title">'+ all_faq[0].title +'</h5>'+
                    '<h6 class="card-subtitle mb-2 text-body-secondary">Kategori: '+ all_faq[0].category.name +'</h6>' +
                    '<p class="card-text">'+ all_faq[0].answer +'</p>'+
                    '<a href="#" class="card-link">Card link</a>'+
                    '<a href="#" class="card-link">Another link</a>'+
                    '</div>'+'</div>'
  
              $('#faq-list').append(cardItem);
          }
  </script>
@endpush
