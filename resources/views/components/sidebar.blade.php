<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">HISTEC</a>
        </div>
        {{-- <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div> --}}
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">  
                </ul>
            </li>
            @can('view-technician')
            <li class="menu-header">Tiket</li>
            <li class="nav-item dropdown {{ $type_menu === 'tiket_nav' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-list-ul"></i> <span>Tiket</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('tiket/semua_tiket') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexSemuaTiket') }}">Semua Tiket</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('tiket/tiket_ditugaskan') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexTiketDitugaskan') }}">Tiket Ditugaskan</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('tiket/mutasi_tiket') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexMutasiTiket') }}">Mutasi Tiket</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('tiket/status_tiket') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexStatusTiket') }}">Status Tiket</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('tiket/tiket_selesai') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexTiketSelesai') }}">Tiket Selesai</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Balasan Tiket</li>
            <li class="{{ Request::is('balasan_tiket') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('indexBalasanTiket') }}"><i class="fas fa-reply-all"></i> <span>Balasan Tiket</span></a>
            </li>
            {{-- <li class="menu-header">Blank Page</li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank Page</span></a>
            </li> --}}
            <li class="menu-header">Kategori</li>
            <li class="nav-item dropdown {{ $type_menu === 'kategori_nav' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="far fa-square"></i> <span>Kategori</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('kategori') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('index.kategori') }}">Kategori</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">FAQ</li>
            <li class="nav-item dropdown {{ $type_menu === 'faq_nav' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-question"></i> <span>FAQ</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('faq_admin_page/index') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexFaqAdmin') }}">FAQ</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('view-kepala-upttik')
            <li class="menu-header">User</li>
            <li class="nav-item dropdown {{ $type_menu === 'user' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('user') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}">User</a>
                    </li>
                    
                </ul>
            </li>
            @endcan
            @can('view-technician')
            <li class="menu-header">Berita Penyelesaian</li>
            <li class="nav-item dropdown {{ $type_menu === 'berita_penyelesaian' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                    <span>Berita Penyelesaian</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('berita_penyelesaian/index') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('berita_penyelesaian.index') }}">Buat Berita Penyelesaian</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('view-kepala-upttik')
            <li class="menu-header">Laporan</li>
            <li class="nav-item dropdown {{ $type_menu === 'laporan' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i>
                    <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('laporan/index') ? 'active' : '' }}">
                        <a href="{{ route('indexLaporan') }}">Laporan</a>
                    </li>
                </ul>
            </li>
            @endcan
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('credits') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>Credits</span>
                </a>
            </li>
        </ul>
        
    </aside>
</div>

