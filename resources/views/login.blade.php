@extends('layout.login-master')

@section('title', "Login :: Dashboad Stunting")

@section('content')
    <div class="d-flex flex-row">
        @csrf
        <div class="d-flex justify-content-center align-items-center mb-4">
        	<div class="p-5">
        		<img class="img-fluid img-logo-login" src="{!! asset('img/logo3.png') !!}" alt="">
        	</div>
        </div>

        <div class="bg-light w-100 p-5">
            <h1 class="h3 mb-3 fw-normal text-center">
                Login
            </h1>
            @include('layout.partials.messages')
            <form method="post" action="{{ route('login.perform') }}">
                @csrf
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

                <div class="form-group form-floating mb-3">
                    <button class="w-100 btn btn-lg btn-teal text-light" type="submit">Login</button>
                </div>
            </form>
            <a class="mt-5" href="{{ route('dashboard') }}">Lihat Dashboard</a>
            @include('layout.partials.copy')
        </div>
    </div>
@endsection