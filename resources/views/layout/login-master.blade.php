@include('layout.header')
<div class="row">
    <main class="col-sm-11 col-md-8 col-lg-4 position-absolute top-50 start-50 translate-middle">
        <div class="card card-body shadow">
            @yield('content')
        </div>
    </main>
</div>

@include('layout.footer')