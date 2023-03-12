@extends('layout.master')

@section('title', "Pengguna :: Dashboard Stunting")

@section('content')
    <div class="container-fluid pt-3 vh-100">
        <div class="row g-3">
            @if(in_array($method, ['Tambah', 'Edit', 'Hapus']))
                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <a href="{{ url('/pengguna') }}" class="btn btn-sm btn-secondary float-start">
                                <span data-feather="arrow-left"></span>
                            </a>
                            <h4 class="card-category">{{ $method }} Pengguna</h4>
                        </div>
                        <div class="card-body">
                            @include('layout.partials.messages')
                            <form method="post" action="{{ route('pengguna.perform', ['method' => $method]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="nip" id="nip" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('nip') : $user->nip }}" placeholder="19xxxxxxxxxxxxxxx" required="required" autofocus onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="18">
                                    <label for="floatingNIP">NIP</label>
                                    @if ($errors->has('nip'))
                                        <span class="text-danger text-left">{{ $errors->first('nip') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <input type="hidden" class="form-control" name="nama" id="nama" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('nama') : $user->nama }}" placeholder="Nama">
                                    <input type="text" class="form-control" id="nama1" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('nama') : $user->nama }}" placeholder="Nama" disabled>
                                    <label for="floatingNama">Nama</label>
                                    @if ($errors->has('nama'))
                                        <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <select class="form-select" name="gid">
                                        <option selected disabled>Pilih Group</option>
                                        @foreach($group as $key => $value)
                                            @if(isset($user) && $value->id == $user->gid)
                                                <option value="{{$value->id}}" selected>{{$value->nama}}</option>
                                            @else
                                                <option value="{{$value->id}}">{{$value->nama}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="floatingNama">Group Akses</label>
                                    @if ($errors->has('gid'))
                                        <span class="text-danger text-left">{{ $errors->first('gid') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="no_hp" value="{{ (!isset($user) && ($method == 'Tambah')) ? old('no_hp') : $user->no_hp }}" placeholder="Nomor HP">
                                    <label for="floatingNama">Nomor HP</label>
                                    @if ($errors->has('no_hp'))
                                        <span class="text-danger text-left">{{ $errors->first('no_hp') }}</span>
                                    @endif
                                </div>

                                @if(isset($user) && ($method != 'Tambah'))
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
                                @else
                                    <button class="w-100 btn btn-lg btn-primary" type="submit">Simpan</button>
                                @endif
                                
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
                            <div class="table-responsive">
                                <table id="tbData" class="table table-striped-columns">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">NIP</th>
                                            <th>Nama</th>
                                            <th width="35%">Nomor HP</th>
                                            <th width="5%">Aksi</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($user)
                                            @foreach($user as $key => $value)
                                                <tr>
                                                    <td>{{$key +1}}</td>
                                                    <td class="text-center">{{ $value->nip }}</td>
                                                    <td>{{ $value->nama }}</td>
                                                    <td class="text-center">{{ $value->remember_token }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-between gap-1">
                                                            <a href="{{ route('pengguna.edit', ['id' => $value->id]) }}" class="btn btn-sm btn-primary">
                                                                <span data-feather="edit"></span>
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
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js-content')
<script type="text/javascript"> 
    document.addEventListener('DOMContentLoaded', function () {
        let table = new DataTable('#tbData', {
            paging: false,
            ordering: false,
            info: false,
        });
    });

    document.getElementById("nip").addEventListener('keyup', function(e) {
        var input_value = this.value;

        checkNIP(input_value)
    });

    function checkNIP(l) {
        if(l.length == '8' || l.length == '18'){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                     let retval = JSON.parse(this.responseText);
                     console.log(retval)
                     
                     if(retval['status'] == 200){
                        document.getElementById('nama').value = retval['datapegawai']['nama'];
                        document.getElementById('nama1').value = retval['datapegawai']['nama'];
                     }else{
                        alert(retval['message'])
                        document.getElementById('nama').value = '';
                        document.getElementById('nama1').value = '';
                     }
                 }
            };
            xhttp.open("GET", "/api/getPegawai/"+l, true);
            //xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send();
        }
    }

</script>
@endsection