@include('layout.header')

    @if(!isset($side))
        <div class="row">
            @include('layout.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10">
                @yield('content')        
            </main>
        </div>
    @else
        <div>
            @include('layout.no_sidebar')
            <div class="container">
                @yield('content')        
            </div>
        </div>
    @endif 
@yield('js-content')
@include('layout.footer')