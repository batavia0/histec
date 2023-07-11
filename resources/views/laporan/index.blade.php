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
                                    class="btn">Text</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="summary">
                                <div class="summary-info"
                                    data-tab-group="summary-tab"
                                    id="summary-text">
                                    <h4>$1,858</h4>
                                    <div class="text-muted">Sold 4 items on 2 customers</div>
                                    <div class="d-block mt-2">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                                <div class="summary-chart active"
                                    data-tab-group="summary-tab"
                                    id="summary-chart">
                                    <canvas id="myChart"
                                        height="100"></canvas>
                                </div>
                                <div class="summary-item">
                                    <h6 class="mt-3">Item List <span class="text-muted">(1 Items)</span></h6>
                                    <ul class="list-unstyled list-unstyled-border">
                                        <li class="media">
                                            <a href="#">
                                                <img alt="image"
                                                    class="mr-3 rounded"
                                                    width="50"
                                                    src="{{ asset('img/products/product-4-50.png') }}">
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right">angka</div>
                                                <div class="media-title"><a href="#">iBook Noob</a></div>
                                                <div class="text-small text-muted">by <a href="#">Ahmad
                                                        Sutisna</a>
                                                    <div class="bullet"></div> Sunday
                                                </div>
                                            </div>
                                        </li>
                                        
                                        
                                        
                                    </ul>
                                </div>
                            </div>
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
        var weekday = @json($labels);
        var dataset = @json($dataset);
        var dataset_open = @json($dataset_open);
     </script>
    <script src="{{ asset('js/laporan-statistic.js') }}"></script>

    <script>
//         $.ajaxSetup({
//    headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//    }
// });
     </script>
     
@endpush
