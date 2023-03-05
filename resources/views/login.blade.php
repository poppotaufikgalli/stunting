@extends('layout.login-master')

@section('title', "Login :: Pelayanan Terpadu")

@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="d-flex justify-content-center mb-4">
        	<div class="bg-primary rounded-circle p-5">
        		<img class="img-fluid img-logo-login" src="{!! asset('img/logo3.png') !!}" alt="">
        	</div>
        </div>
        
        <h1 class="h3 mb-3 fw-normal text-center">Login</h1>

        @include('layout.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="NIP" required="required" autofocus>
            <label for="floatingName">NIP</label>
            @if ($errors->has('nip'))
                <span class="text-danger text-left">{{ $errors->first('nip') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        
        @include('layout.partials.copy')
    </form>
@endsection