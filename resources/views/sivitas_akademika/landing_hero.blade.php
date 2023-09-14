<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="https://i.site.pictures/zFNWD.th.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SISTEM INFORMASI HELPDESK TICKETING&mdash;POLSUB</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('Resi/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Resi/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Resi/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Resi/vendor/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('Resi/vendor/bootstrap-icons/bootstrap-icons.css') }}">
      
    @stack('style')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('Resi/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    @vite([])
</head>
<body>
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
          <div class="row">
            <div class="col-lg-6 pt-2 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <div id="typing-text">
                    <h1>Saya butuh bantuan pada fasilitas perangkat TIK di kampus</h1>
                </div>
              <ul>
                <li><i class="ri-check-line"></i> Mudah hanya beberapa langkah</li>
                <li><i class="ri-check-line"></i> Dapat diakses kapanpun</li>
                <li><i class="ri-check-line"></i> Mandiri</li>
              </ul>
              <div class="mt-3">
                <a href="/" class="btn-get-started scrollto">Minta bantuan</a>
                {{-- <a href="" class="btn-get-quote">Request a Quote</a> --}}
              </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <img src="{{ asset('product_logo_histec_1000x200.png') }}" alt="product_logo_histec.png" border="0" />
            </div>
          </div>
        </div>
    
      </section>
      <footer id="footer">    
        <div class="container d-md-flex py-4">
    
          <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
              &copy; Copyright <strong><span>HISTEC Polsub</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/resi-free-bootstrap-html-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
          
        </div>
      </footer>


    <!-- General JS Scripts -->
    <script src="{{ asset('Resi/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Resi/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('Resi/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Resi/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('Resi/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @stack('scripts')
  
    <!-- Template Main JS File -->
    <script src="{{ asset('Resi/js/main.js') }}"></script>
  </body>
</html>
