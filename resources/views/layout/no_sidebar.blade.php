<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-teal bg-gradient" id="headerZero">
    <div class="container">
        <div class="d-flex flex-column align-items-center w-100" id="headerOne">
            <img src="{{asset('img/logo-tpi.png')}}"  height="100" class="p-2">
            <h3 class="h1 text-white">Dashboard Kolaborasi Penanganan Stunting Kota Tanjungpinang</h3>
        </div>
    </div>
</nav>
<script type="text/javascript">
    const scrollOffset = 100;
    

    window.onscroll = function(e) {
        const headerOne = document.getElementById('headerOne');
        var top =    window.pageYOffset || document.documentElement.scrollTop;
        console.log(top)
        if (top > scrollOffset) {
            if(headerOne.classList.contains('flex-column')){
                document.getElementById('headerOne').classList.remove('flex-column');    
            }
            document.getElementById('headerOne').classList.add('flex-row');
        } else {
            if(headerOne.classList.contains('flex-row')){
                document.getElementById('headerOne').classList.remove('flex-row');
            }
            document.getElementById('headerOne').classList.add('flex-column');
        }
    };
</script>