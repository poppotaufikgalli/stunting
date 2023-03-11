@extends('layout.master')

@section('title', "Unautorized")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">
		
		<div class="container py-4 vh-100">
			@include('layout.partials.messages')
            <!-- 404 Error Text -->
            <div class="text-center">
                <div class="error mx-auto" data-text="404">401</div>
                <p class="lead text-gray-800 mb-5">Error, Halaman Tidak Sesuai Hak Akses</p>
                <p class="text-gray-500 mb-0">Halaman akan Anda Akses tidak sesuai Hak Akses yang Anda miliki</p>
                <a href="{{url()->previous()}}">&larr; Kembali Ke Halaman Sebelum</a>
            </div>

        </div>
        <!-- /.container-fluid -->

	</div>
	<!-- /.container-fluid -->
@endsection

@section('js-content')
<script type="text/javascript">
	window.onload = (event)=> {
  		let myAlert = document.querySelector('.toast');
  		if(myAlert){
    		let bsAlert = new bootstrap.Toast(myAlert);
    		bsAlert.show(); 
  		}
  	}
</script>
@endsection
	