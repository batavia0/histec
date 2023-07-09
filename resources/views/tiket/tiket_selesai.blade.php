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
                <h1>Tiket Selesai</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Tiket</a></div>
                    <div class="breadcrumb-item">Tiket Selesai</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tiket Selesai</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
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
                                        <th>Dari Tanggal</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Gambar</th>
                                    </tr>
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
                                        <td>1</td>
                                        <td>Create a mobile app</td>
                                        <td>05-07-2023</td>
                                        <td>--|--</td>
                                        <td>
                                            <div class="badge badge-success">Open</div>
                                        </td>
                                        <td><a href="#"
                                                class="btn btn-outline-primary">Detail</a>
                                            <a href="#"
                                                class="btn btn-info"><i class="fas fa-handshake-alt"></i></a>
                                            <a href="#"
                                                class="btn btn-primary">Edit</a>
                                            <a href="#"
                                                class="btn btn-danger"
                                                data-toggle="tooltip"
                                                title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')">Hapus</a>
                                            </td>
                                        <td>
                                            <img alt="image"
                                                src="https://placehold.co/200x200/png"
                                                width="200"
                                                data-toggle="tooltip"
                                                title="#">
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link"
                                            href="#"
                                            tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link"
                                            href="#">1 <span class="sr-only">(current)</span></a></li>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link"
                                            href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Posts</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Introduction Laravel 5
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="d-inline">Tasks</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-1">
                                        <label class="custom-control-label"
                                            for="cbx-1"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-4.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Redesign header</a></h6>
                                        <div class="text-small text-muted">Alfa Zulkarnain <div class="bullet"></div>
                                            <span class="text-primary">Now</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-2"
                                            checked="">
                                        <label class="custom-control-label"
                                            for="cbx-2"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-5.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-primary float-right mb-1">Completed</div>
                                        <h6 class="media-title"><a href="#">Add a new component</a></h6>
                                        <div class="text-small text-muted">Serj Tankian <div class="bullet"></div> 4 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-3">
                                        <label class="custom-control-label"
                                            for="cbx-3"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-2.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-warning float-right mb-1">Progress</div>
                                        <h6 class="media-title"><a href="#">Fix modal window</a></h6>
                                        <div class="text-small text-muted">Ujang Maman <div class="bullet"></div> 8 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-4">
                                        <label class="custom-control-label"
                                            for="cbx-4"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Remove unwanted classes</a></h6>
                                        <div class="text-small text-muted">Farhan A Mujib <div class="bullet"></div> 21
                                            Min</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('stisla/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('stisla/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('stisla/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('stisla/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('stisla/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/js/page/index-0.js') }}"></script>
@endpush
