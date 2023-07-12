<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      {{-- <div>
        <p class="lead">SISTEM INFORMASI HELPDESK TICKETING</p>
      </div> --}}
      <h1 class="logo"><a href="index.html">HISTEC</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      {{-- <a href="{{ route('tickets.index') }}" class="logo"><img src="https://i.site.pictures/ncXrg.th.png" alt="ncXrg.png" class="img-fluid" border="0"></a> --}}

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto {{ Request::is('tickets') ? 'active' : '' }}" href="{{ route('tickets.index') }}">Home</a></li>
          <li><a class="nav-link scrollto {{ Request::is('cek_status_tiket') ? 'active' : '' }}" href="{{ route('indexCekStatusTiket') }}">Cek Status Tiket</a></li>
          {{-- <li class="dropdown"><a href="#"><span>FAQ</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">FAQ</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Jaringan Internet</a></li>
                  <li><a href="#">Hardware</a></li>
                  <li><a href="#">Software</a></li>
                </ul>
              </li>
            </ul>
          </li> --}}
          <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>