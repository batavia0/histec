@extends('layouts.appstisla')

@section('title', 'Laporan')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="{{ asset('stisla/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}"> --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('indexLaporan') }}">Laporan</a></div>
                    <div class="breadcrumb-item">Laporan</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ringkasan</h4>
                            <div class="card-header-action">
                                <a href="#summary-chart"
                                    data-tab="summary-tab"
                                    class="btn active">Grafik</a>
                                <a href="#summary-text"
                                    data-tab="summary-tab"
                                    class="btn"
                                    onclick="printChart('myChart2')"><i class="fas fa-print"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ringkasan</h4>
                            <div class="card-header-action">
                                <a href="#summary-chart"
                                    data-tab="summary-tab"
                                    class="btn active">Grafik</a>
                                <a href="#summary-text"
                                data-tab="summary-tab"
                                class="btn"
                                onclick="printChart('myChart3')"><i class="fas fa-print"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('stisla/library/chart.js/dist/Chart.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        var _ydata = {!! json_encode($month) !!};
        var _xdata = JSON.parse('{!! json_encode($monthCount) !!}');
        var _label = 'Tiket Dibuat';
        var _labelFinished = 'Tiket Selesai';
        var _ymonthsFinished = {!! json_encode($monthsFinished) !!};
        var _xmonthCountFinished= JSON.parse('{!! json_encode($monthCountFinished) !!}');
     </script>
         <script src="{{ asset('js/laporan.js') }}"></script>
    <script>
//         $.ajaxSetup({
//    headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//    }
// });

function printChart(elementId) {
    var canvas = document.getElementById(elementId);
    var base64Image = canvas.toDataURL('image/png');
    var win = window.open();
    win.document.write('<img src="' + base64Image + '"/>');
    win.document.close();
    win.print();
    win.onafterprint = function() {
        win.close();
    };
}

     </script>
     
@endpush
