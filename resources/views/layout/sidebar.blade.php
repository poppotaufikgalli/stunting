<nav class="navbar navbar-expand-lg navbar-dark bg-teal sticky-top">
    <div class="container-fluid mx-3">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{asset('img/logo3.png')}}"  height="46" class="">
            &nbsp;&nbsp;&nbsp;
            <h3 class="h4 text-light">Dashboard Stunting Kota Tanjungpinang</h3>
        </div>
        @if(Session::get('nama'))
            <div class="navbar-nav">
                <div class="nav-item text-nowrap d-flex flex-row align-items-center">
                    <a class="nav-link badge bg-light text-teal me-4" href="{{ route('logout.perform') }}">Halo, {{Session::get('nama')}}</a>
                    <a class="nav-link" href="{{ route('logout.perform') }}">Logout</a>
                </div>
            </div>
        @else
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('login.perform') }}">Login</a>
                </div>
          </div>
        @endif
    </div>
</nav>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar sidebar-sticky collapse">
    <div class="container">
        
    </div>
    <div class="position-sticky pt-3">
        <div class="container">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Dashboard' ? 'active' : '' }}" aria-current="page" href="{{route('vdashboard')}}">
                        <span data-feather="home"></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Pengguna' ? 'active' : '' }}" href="{{url('/pengguna')}}">
                        <span data-feather="user"></span>
                        Pengguna
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Group' ? 'active' : '' }}" href="{{url('/group')}}">
                        <span data-feather="users"></span>
                        Group
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link {{isset($page) && $page == 'ilsimil' ? 'active' : '' }}" href="{{route('ilsimil')}}">
                        <span data-feather="layers"></span>
                        ILSIMIL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'eppgbm' ? 'active' : '' }}" href="{{route('eppgbm')}}">
                        <span data-feather="layers"></span>
                        EPPGBM
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link {{isset($page) && $page == 'ekohot' ? 'active' : '' }}" href="{{route('ekohot')}}">
                        <span data-feather="layers"></span>
                        EKOHOT
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{isset($page) && $page == 'Upload' ? 'active' : '' }}" href="{{url('/upload')}}">
                        <span data-feather="layers"></span>
                        Upload
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>