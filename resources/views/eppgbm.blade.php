@extends('layout.master')

@section('title', "Pengguna :: Dashboard Stunting")

@section('content')
    <div class="container-fluid pt-3">
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
                                {{ $method }} EPPGBM
                                <a href="{{ url('/pengguna/tambah') }}" class="btn btn-sm btn-success float-end">
                                    <span data-feather="plus"></span>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('layout.partials.messages')
                            <div class="table-responsive">
                                <table id="tbData" class="table table-striped-columns small">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Posyandu / Puskesmas</th>
                                            <th>Alamat</th>
                                            <th>Kelurahan</th>
                                            <th>Kecamatan</th>
                                            <th>Tinggi</th>
                                            <th>Berat</th>
                                            <th>BB/U</th>
                                            <th>TB/U</th>
                                            <th>BB/TB</th>
                                            <th>Tgl Pengukuran</th>
                                            <th width="5%">Aksi</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data)
                                            @foreach($data as $key => $value)
                                                <tr>
                                                    <td>{{$key +1}}</td>
                                                    <td class="text-center">{{ $value->nik }}</td>
                                                    <td>
                                                        {{ $value->balitas->nama }} ({{$value->balitas->jk}})<br>
                                                        {{ date("d-m-Y", strtotime($value->balitas->tgl_lahir)) }}
                                                    </td>
                                                    <td>{{ $value->posyandu }}<br>{{ $value->puskesmas }}</td>
                                                    <td>{{ $value->balitas->alamat }} RT. {{$value->balitas->rt}} RW. {{$value->balitas->rw}} Kel. {{$value->balitas->desa_kel}} Kec. {{$value->balitas->kec}}</td>
                                                    <td>{{$value->balitas->desa_kel}}</td>
                                                    <td>{{$value->balitas->kec}}</td>
                                                    <td>{{ $value->tinggi }}</td>
                                                    <td>{{ $value->berat }}</td>
                                                    <td>{{ $value->bb_u }}</td>
                                                    <td>{{ $value->tb_u }}</td>
                                                    <td>{{ $value->bb_tb }}</td>
                                                    <td>{{ $value->tgl_pengukuran }}</td>
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
            paging: true,
            ordering: true,
            info: true,
        });
    });

</script>
@endsection