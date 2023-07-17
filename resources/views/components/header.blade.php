@auth
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#"
                    data-toggle="sidebar"
                    class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <!-- Notification -->
        <li class="dropdown dropdown-list-toggle">
            <a href="#"
            data-toggle="dropdown"
            class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right" style="overflow-y: auto;">
            <div class="dropdown-header">Notifikasi
                {{-- <div class="float-right">
                    <a href="#">Tandai sudah dibaca semua</a>
                </div> --}}
            </div>
            <div class="dropdown-list-content dropdown-list-icons" id="notification_list">
                
            </div>
            <div class="dropdown-footer text-center">
                <a href="#">Lihat semua <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </li>
            <!-- END Notification -->
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="https://img.icons8.com/pastel-glyph/64/user-male-circle.png" alt="user-male-circle"
                    class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">{{ Auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                <a href="features-profile.html"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profil
                </a>
                <a href="features-settings.html"
                    class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>
@endauth