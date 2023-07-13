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
                                <div class="col mx-auto py-2">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title">Card title</h5>
                                          <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                          <a href="#" class="card-link">Card link</a>
                                          <a href="#" class="card-link">Another link</a>
                                        </div>
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
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>

    </script>
@endpush
