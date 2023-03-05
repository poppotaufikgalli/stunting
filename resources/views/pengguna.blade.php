@extends('layout.master')

@section('title', "Pengguna :: Pelayanan Terpadu")

@section('content')
    <div class="container-fluid pt-3">
        <div class="row g-3">
            @if(in_array($method, ['Tambah', 'Edit', 'Hapus']))
                <div class="col-md-6 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <a href="{{ url('/pengguna') }}" class="btn btn-sm btn-secondary float-start">
                                <span data-feather="arrow-left"></span>
                            </a>
                            <h4 class="card-category">{{ $method }} Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('pengguna.perform', ['method' => $method]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="nip" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('nip') : $user->nip }}" placeholder="19xxxxxxxxxxxxxxx" required="required" autofocus>
                                    <label for="floatingNIP">NIP</label>
                                    @if ($errors->has('nip'))
                                        <span class="text-danger text-left">{{ $errors->first('nip') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="nama" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('nama') : $user->nama }}" placeholder="Nama" required="required" autofocus>
                                    <label for="floatingNama">Nama</label>
                                    @if ($errors->has('nama'))
                                        <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="jabatan" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('jabatan') : $user->jabatan }}" placeholder="Jabatan" required="required" autofocus>
                                    <label for="floatingJabatan">Jabatan</label>
                                    @if ($errors->has('jabatan'))
                                        <span class="text-danger text-left">{{ $errors->first('jabatan') }}</span>
                                    @endif
                                </div>
                                @if(!isset($user) && ($method == 'Tambah'))
                                    <div class="form-group form-floating mb-3">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
                                        <label for="floatingEmail">Email address</label>
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
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
                                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                                        <label for="floatingConfirmPassword">Confirm Password</label>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <button class="w-100 btn btn-lg btn-primary" type="submit">Tambah</button>
                                @else
                                    <div class="form-group form-floating mb-3">
                                        <input type="hidden" class="form-control" name="id" value="{{ $user->id }}" placeholder="ID" required="required" autofocus>
                                        <label for="floatingID">ID</label>
                                        @if ($errors->has('id'))
                                            <span class="text-danger text-left">{{ $errors->first('id') }}</span>
                                        @endif
                                    </div>

                                    @if($method == 'Hapus')
                                        <button class="w-100 btn btn-lg btn-danger" type="submit">Hapus</button>
                                    @else
                                        <button class="w-100 btn btn-lg btn-primary" type="submit">Ubah</button>
                                    @endif
                                @endif
                                
                            </form>
                        </div>
                    </div>
                </div>
            @elseif($method == 'Reset Password')
                <div class="col-md-6 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <a href="{{ url('/pengguna') }}" class="btn btn-sm btn-secondary float-start">
                                <span data-feather="arrow-left"></span>
                            </a>
                            <h4 class="card-category">{{ $method }} Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('pengguna.perform', ['method' => 'resetpassword']) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="nama" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('nama') : $user->nama }}" placeholder="Nama" required="required" disabled>
                                    <label for="floatingNama">Nama</label>
                                    @if ($errors->has('nama'))
                                        <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
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
                                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                                    <label for="floatingConfirmPassword">Confirm Password</label>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <div class="form-group form-floating mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{ $user->id }}" placeholder="ID" required="required" autofocus>
                                    <label for="floatingID">ID</label>
                                    @if ($errors->has('id'))
                                        <span class="text-danger text-left">{{ $errors->first('id') }}</span>
                                    @endif
                                </div>
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Reset</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <h4 class="card-category">
                                {{ $method }} Pengguna
                                <a href="{{ url('/pengguna/tambah') }}" class="btn btn-sm btn-success float-end">
                                    <span data-feather="plus"></span>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('layout.partials.messages')
                            <table class="table table-sm table-hover">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Aksi</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($user)
                                        @foreach($user as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $value->nip }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->jabatan }}</td>
                                                <td class="text-center">{{ $value->email }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between gap-1">
                                                        <a href="{{ route('pengguna.edit', ['id' => $value->id]) }}" class="btn btn-sm btn-primary">
                                                            <span data-feather="edit"></span>
                                                        </a>
                                                        <a href="{{ route('pengguna.resetpassword', ['id' => $value->id]) }}" class="btn btn-sm btn-warning">
                                                            <span data-feather="key"></span>
                                                        </a>
                                                        <a href="{{ route('pengguna.hapus', ['id' => $value->id]) }}"  class="btn btn-sm btn-danger">
                                                            <span data-feather="trash"></span>
                                                        </a>
                                                    </div>
                                                </td>                    
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop