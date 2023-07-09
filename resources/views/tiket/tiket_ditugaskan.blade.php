@extends('layouts.appstisla')

@section('title', 'General Dashboard')

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
                <h1>Tiket Ditugaskan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Tiket</a></div>
                    <div class="breadcrumb-item">Tiket Ditugaskan</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tiket Ditugaskan</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            id="search-input"
                                            placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox"
                                                    data-checkboxes="mygroup"
                                                    data-checkbox-role="dad"
                                                    class="custom-control-input"
                                                    id="checkbox-all">
                                                <label for="checkbox-all"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>ID Tiket</th>
                                        <th>Dari Tanggal</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Gambar</th>
                                    </tr>
                                    @php
                                    $i = ($all_tickets->currentPage() - 1) * $all_tickets->perPage() + 1;
                                    @endphp
                                        @foreach ($all_tickets as $row)
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox"
                                                    data-checkboxes="mygroup"
                                                    class="custom-control-input"
                                                    id="checkbox-1">
                                                <label for="checkbox-1"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{  $i++ }}</td>
                                        <td>{{ trim($row->name) }}</td>
                                        <td>{{ trim($row->description) }}</td>
                                        <td>{{ $row->ticket_no }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ isset($row->ticket_finished_at)?($row->ticket_finished_at): '--|--' }}</td>
                                        <td>
                                            <div class="badge badge-success">{{ $row->ticket_status->name }}</div>
                                            <div class="badge">{{ $row->category->name }}</div>
                                            <div class="badge">{{ $row->locations->name }}</div>
                                        </td>
                                        <td><a href="#"
                                                class="btn btn-sm btn-outline-primary"
                                                onclick="read({{ $row->ticket_id }})">Detail</a>
                                            <a href="#"
                                                class="btn btn-sm btn-info"
                                                data-toggle="tooltip"
                                                title="Mutasi Tiket"><i class="fas fa-handshake-alt"></i></a>
                                            <a href="#"
                                                class="btn btn-sm btn-primary"
                                                title="Update"
                                                onclick="edit({{ $row->ticket_id }})">Perbarui</a>

                                            <a href="#"
                                                class="btn btn-sm btn-danger"
                                                data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="deleteConfirm({{ $row->ticket_id }})">Hapus</a>
                                            </td>
                                        <td>
                                            <img alt="image"
                                                src="{{ $row->image }}"
                                                width="200"
                                                data-toggle="tooltip"
                                                title="#">
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{-- Pagination --}}
                        <div class="card-footer text-right">
                            {{ $all_tickets->links() }}
                            @if ($all_tickets['links'])
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    @foreach ($all_tickets['links'] as $item)
                                    <li class="page-item {{ $item['active']?'active':'' }}"><a class="page-link"
                                        href="{{ $item['url'] }}">{!! $item['label'] !!}</a></li>
                                    @endforeach                                        
                                </ul>
                            </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase(); // Ambil nilai teks pencarian dan ubah ke huruf kecil

        // Saring baris tabel berdasarkan teks pencarian
        $('table tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.includes(searchValue)) {
                $(this).show(); // Tampilkan baris jika cocok dengan pencarian
            } else {
                $(this).hide(); // Sembunyikan baris jika tidak cocok dengan pencarian
            }
                });
            });
        });
    </script>
@endpush
