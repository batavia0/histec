<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
        name="viewport">
    <title>@yield('title') &mdash; HISTEC Polsub</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- General CSS Files -->
    <link rel="stylesheet"
        href="{{ asset('stisla/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/css/components.css') }}">

    <!-- Start GA -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
    @vite([])
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('stisla/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('stisla/js/stisla.js') }}"></script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/js/custom.js') }}"></script>
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
