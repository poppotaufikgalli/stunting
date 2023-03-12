@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li class="text-center">{{ $error }}</li>
            @endforeach
        </ul>
        <div class="progress" role="progressbar" aria-label="Count Time Close Alert" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 3px; transition-duration: 3s;">
          <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: 100%"></div>
        </div>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
                <div class="progress" role="progressbar" aria-label="Count Time Close Alert" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 3px; transition-duration: 3s;">
                    <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width: 100%"></div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
            <div class="progress" role="progressbar" aria-label="Count Time Close Alert" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 3px; transition-duration: 3s;">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width: 100%"></div>
            </div>
        </div>
    @endif
@endif

<script type="text/javascript">
    var bar = document.querySelector(".progress")
    var alert = document.querySelector(".alert")

    if(alert){
        setTimeout(function() {
            bootstrap.Alert.getOrCreateInstance(alert).close();
        }, 8000);    
    }
    

    if(bar){
        var i1 = setInterval(function() {
            val = parseInt(bar.getAttribute('aria-valuenow'));
            val -= 1;
            //console.log(val);
            if( val > 1) {
                bar.setAttribute('aria-valuenow', val);
                document.querySelector(".progress-bar").style.width = val +'%'
                //bar.css('width', val + '%');
            } else {
                clearInterval(i1);
            }
        }, 75);    
    }
    
</script>