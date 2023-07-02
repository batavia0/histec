<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>&mdash;</title>

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

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @vite([])
</head>
<body>
    <section class="main">
        @yield('content')
    </section>


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
