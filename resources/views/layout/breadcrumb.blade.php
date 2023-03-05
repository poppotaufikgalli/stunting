<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
      </svg>
      {{$page}}
    </span>
    @auth
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link" href="#">Logout</a>
        </div>
      </div>
    @endauth

    @guest
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link" href="#">Login</a>
        </div>
      </div>
    @endguest
  </div>
</nav>