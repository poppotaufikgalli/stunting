@include('layout.header')
<div class="row">
    @include('layout.sidebar')
    <main class="col-md-9 ms-sm-auto col-lg-10">
        @yield('content')

        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>
</div>

@include('layout.footer')