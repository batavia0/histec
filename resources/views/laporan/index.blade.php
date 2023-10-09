@extends('layouts.appstisla')

@section('title', 'Laporan')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="{{ asset('stisla/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset('stisla/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/library/selectric/public/selectric.css') }}">
<link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sp-2.2.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

@endpush

@section('main')
@can('view-kepala-upttik')
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
                            <h4>Tiket Dibuat</h4>
                            {{-- <div class="card-header-action">
                                <a href="#summary-chart"
                                    data-tab="summary-tab"
                                    class="btn active">Grafik</a>
                                <a href="#summary-text"
                                    data-tab="summary-tab"
                                    class="btn"
                                    onclick="printChart('myChart2')"><i class="fas fa-print"></i></a>
                            </div> --}}
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 col-sm-12">
                            <form action="" id="formLaporanFilter">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control daterange-cus"
                                        name="date">
                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            {{-- <canvas id="myChart2"></canvas> --}}
                            <table id="filteredTable" class="display">
                                
                                <tbody>
                                    <!-- Table rows will be populated dynamically using JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tiket Selesai</h4>
                            {{-- <div class="card-header-action">
                                <a href="#summary-chart"
                                    data-tab="summary-tab"
                                    class="btn active">Grafik</a>
                                <a href="#summary-text"
                                    data-tab="summary-tab"
                                    class="btn"
                                    onclick="printChart('myChart2')"><i class="fas fa-print"></i></a>
                            </div> --}}
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 col-sm-12">
                            <form action="" id="formLaporanFilterTiketSelesai">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control daterange-cus"
                                        name="date">
                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            {{-- <canvas id="myChart2"></canvas> --}}
                            <table id="filteredTableTiketSelesai" class="display">
                                <tbody>
                                    <!-- Table rows will be populated dynamically using JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ringkasan</h4>
                            <div class="card-header-action">
                                <a href="#summary-chart"
                                    data-tab="summary-tab"
                                    class="btn active">Grafik</a>
                                <a href="#summary-text"
                                data-tab="summary-tab"
                                class="btn"></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
    @endcan
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('stisla/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('stisla/library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('stisla/library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    {{-- Datatables --}}
    {{-- <script src="{{ asset('stisla/library/datatables/media/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sp-2.2.0/sr-1.3.0/datatables.min.js"></script>
    
    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/js/page/forms-advanced-forms.js') }}"></script>

    <script>
    $(document).ready(function() {
    // Initialize DataTable() with your table
    var table = $('#filteredTable').DataTable({
        language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
        columns: [
            {
                data: 'name', title: 'Judul'
            },
            {
                data: 'email', title: 'Email'
            },
            {
                data: 'ticket_no', title: 'ID Tiket'
            },
            {
                data: 'created_at', title: 'Dibuat Tanggal',
                render: function(data, type, row){
                    return moment(data).format('DD MMMM YYYY');
                }
            }
        ],
        dom: 'Blfrtip',
        buttons: [{
            extend: 'copy',
            text: '<i class="fa fa-copy"></i> Copy'
        },
        {
            extend: 'csv',
            text: '<i class="fa fa-file-csv"></i> CSV'
        },
        {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i> Excel'
        },
        {
            extend: 'pdf',
            text: '<i class="fa fa-file-pdf"></i> PDF'
        },
        {
            extend: 'print',
            text: '<i class="fa fa-print"></i> Print'
        }
    ]
    });

    var tableTiketSelesai = $('#filteredTableTiketSelesai').DataTable({
        language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
        columns: [
            {
                data: 'name', title: 'Judul'
            },
            {
                data: 'email', title: 'Email'
            },
            {
                data: 'ticket_no', title: 'ID Tiket'
            },
            {
                data: 'ticket_finished_at', title: 'Selesai Tanggal',
                render: function(data, type, row){
                    return moment(data).format('DD MMMM YYYY');
                }
            }
        ],
        dom: 'Blfrtip',
        buttons: [{
            extend: 'copy',
            text: '<i class="fa fa-copy"></i> Copy'
        },
        {
            extend: 'csv',
            text: '<i class="fa fa-file-csv"></i> CSV'
        },
        {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i> Excel'
        },
        {
            extend: 'pdf',
            text: '<i class="fa fa-file-pdf"></i> PDF'
        },
        {
            extend: 'print',
            text: '<i class="fa fa-print"></i> Print'
        }
    ]
    });

    // Handle form submission via Fetch
    document.getElementById('formLaporanFilter').addEventListener('submit', function(e) {
        e.preventDefault();

        fetch('{{ route("laporan.filter") }}', {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                // Clear existing table data
                table.clear().draw();

                // Add filtered data to the DataTable
                if (data.length > 0) {
                    table.rows.add(data).draw();
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
    document.getElementById('formLaporanFilterTiketSelesai').addEventListener('submit', function(e) {
        e.preventDefault();

        fetch('{{ route("laporan.filter_tiket_selesai") }}', {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                // Clear existing table data
                tableTiketSelesai.clear().draw();

                // Add filtered data to the DataTable
                if (data.length > 0) {
                    tableTiketSelesai.rows.add(data).draw();
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
});
     </script>
     
@endpush
