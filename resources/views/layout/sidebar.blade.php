<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div class="d-flex justify-content-between align-items-center">
                <img src="{{asset('img/logo3.png')}}"  width="46" height="46">
                &nbsp;&nbsp;&nbsp;
                <h3>SI-DAS</h3>
            </div>
        </a>
        @auth
          <div class="navbar-nav">
            <div class="nav-item text-nowrap">
              <a class="nav-link" href="{{ route('logout.perform') }}">Logout</a>
            </div>
          </div>
        @endauth

        @guest
          <div class="navbar-nav">
            <div class="nav-item text-nowrap">
              <a class="nav-link" href="{{ route('login.perform') }}">Login</a>
            </div>
          </div>
        @endguest
    </div>
</nav>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar sidebar-sticky collapse">
    <div class="container">
        
    </div>
    <div class="position-sticky pt-3">
        <div class="container">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Dashboard' ? 'active' : '' }}" aria-current="page" href="{{url('/dashboard')}}">
                        <span data-feather="home"></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Pengguna' ? 'active' : '' }}" href="{{url('/pengguna')}}">
                        <span data-feather="users"></span>
                        Pengguna
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Upload' ? 'active' : '' }}" href="{{url('/upload')}}">
                        <span data-feather="layers"></span>
                        Upload
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Data' ? 'active' : '' }}" href="{{url('/data')}}">
                        <span data-feather="database"></span>
                        Data
                    </a>
                    <div class="nav-link collapse show">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li>
                                <a href="{{ route('data.izin') }}" class="link-dark d-inline-flex text-decoration-none rounded">
                                    <span data-feather="corner-down-right"></span>
                                    Data Izin
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data.proyek') }}" class="link-dark d-inline-flex text-decoration-none rounded">
                                    <span data-feather="corner-down-right"></span>
                                    Data Proyek
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data.nibkantor') }}" class="link-dark d-inline-flex text-decoration-none rounded">
                                    <span data-feather="corner-down-right"></span>
                                    Data NIB Kantor
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>