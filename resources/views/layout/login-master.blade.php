@include('layout.header')
<div class="row">
    <main class="col-sm-11 col-md-8 col-lg-7 position-absolute top-50 start-50 translate-middle">
        <div class="card card-body shadow bg-teal p-0">
            @yield('content')
        </div>
    </main>
</div>
@yield('js-content')
@include('layout.footer')