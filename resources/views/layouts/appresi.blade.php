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
    <script>
        // Mendapatkan semua elemen dengan kelas "userDateTime"
var userDateTimeElements = document.getElementsByClassName("userDateTime");

// Memformat tanggal untuk setiap elemen
for (var i = 0; i < userDateTimeElements.length; i++) {
    var dateTimeString = userDateTimeElements[i].textContent.trim();
    var formattedDateTime = dateTimeString === '--|--' ? dateTimeString : formatDateTime(dateTimeString);
    userDateTimeElements[i].textContent = formattedDateTime;
}

function formatDateTime(dateTimeString) {
    // Parse the date and time string as UTC
    var dateObj = new Date(dateTimeString + ' UTC');

    // Check if the dateObj is a valid Date object
    if (isNaN(dateObj)) {
        // Invalid date, return the original dateTimeString
        return dateTimeString;
    }

    // Create a new Intl.DateTimeFormat object with the desired options
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone
    };
    var formatter = new Intl.DateTimeFormat(undefined, options);

    // Use the formatter to format the date and time in the user's time zone
    return formatter.format(dateObj);
}

    </script>
  </body>
</html>
