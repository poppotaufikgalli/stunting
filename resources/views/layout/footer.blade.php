        <div class="bg-teal p-0">
            <div class="container">
              <footer class="d-flex flex-wrap justify-content-between align-items-center p-3">
                <p class="col-md-4 mb-0 text-light">© 2023 Diskominfo</p>
                <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-md-4 justify-content-end">
                    @if(Session::get('nip'))
                        <li class="nav-item"><a href="{{route('logout.perform')}}" class="nav-link px-2 text-light">Logout</a></li>
                    @else
                        <li class="nav-item"><a href="{{route('login.show')}}" class="nav-link px-2 text-light">Login</a></li>
                    @endif
                    <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link px-2 text-light">Dashboard</a></li>
                    <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link px-2 text-light">Berita</a></li>
                    <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link px-2 text-light">Infografis</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Hubungi kami</a></li>
                </ul>
              </footer>
            </div>
        </div>
    </body>
</html>