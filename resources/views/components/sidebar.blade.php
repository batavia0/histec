<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">HISTEC</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">  
                </ul>
            </li>
            <li class="menu-header">Tiket</li>
            <li class="nav-item dropdown {{ $type_menu === 'tiket_nav' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="far fa-square"></i> <span>Tiket</span></a>
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
                    <li class="{{ Request::is('tiket/status_tiket') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexTiketSelesai') }}">Tiket Selesai</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank Page</span></a>
            </li>
            
            <li class="menu-header">Kategori</li>
            <li class="nav-item dropdown {{ $type_menu === 'tiket_nav' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="far fa-square"></i> <span>Kategori</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('tiket/semua_tiket') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('indexSemuaTiket') }}">Semua Kategori</a>
                    </li>
                </ul>
            <li class="menu-header">User</li>
            <li class="nav-item dropdown {{ $type_menu === 'auth' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Tambah User</a>
                    </li>
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Edit User</a>
                    </li>
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Hapus User</a>
                    </li>
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Forgot Password</a>
                    </li>
                    <li class="{{ Request::is('auth-login') ? 'active' : '' }}">
                        <a href="{{ url('auth-login') }}">Login</a>
                    </li>
                    <li class="{{ Request::is('auth-login2') ? 'active' : '' }}">
                        <a class="beep beep-sidebar"
                            href="{{ url('auth-login2') }}">Login 2</a>
                    </li>
                    <li class="{{ Request::is('auth-reset-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-reset-password') }}">Reset Password</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Berita Penyelesaian</li>
            <li class="nav-item dropdown {{ $type_menu === 'error' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                    <span>Berita Penyelesaian</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('error-403') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('error-403') }}">Buat Berita Penyelesaian</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'error' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                    <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('error-403') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('error-403') }}">403</a>
                    </li>
                    <li class="{{ Request::is('error-404') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('error-404') }}">404</a>
                    </li>
                    <li class="{{ Request::is('error-500') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('error-500') }}">500</a>
                    </li>
                    <li class="{{ Request::is('error-503') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('error-503') }}">503</a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item dropdown {{ $type_menu === 'features' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('features-activities') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-activities') }}">Activities</a>
                    </li>
                    <li class="{{ Request::is('features-post-create') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-post-create') }}">Post Create</a>
                    </li>
                    <li class="{{ Request::is('features-post') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-post') }}">Posts</a>
                    </li>
                    <li class="{{ Request::is('features-profile') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-profile') }}">Profile</a>
                    </li>
                    <li class="{{ Request::is('features-settings') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-settings') }}">Settings</a>
                    </li>
                    <li class="{{ Request::is('features-setting-detail') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-setting-detail') }}">Setting Detail</a>
                    </li>
                    <li class="{{ Request::is('features-tickets') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('features-tickets') }}">Tickets</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'utilities' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i>
                    <span>Utilities</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('utilities-contact') ? 'active' : '' }}">
                        <a href="{{ url('utilities-contact') }}">Contact</a>
                    </li>
                    <li class="{{ Request::is('utilities-invoice') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('utilities-invoice') }}">Invoice</a>
                    </li>
                    <li class="{{ Request::is('utilities-subscribe') ? 'active' : '' }}">
                        <a href="{{ url('utilities-subscribe') }}">Subscribe</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('credits') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>Credits</span>
                </a>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
