@extends('layout.master')

@section('title', "Orang Tua Asuh :: Dashboard Stunting")

@section('content')
    <div class="container-fluid pt-3 vh-100">
        <div class="row g-3">
            @if(in_array($method, ['Tambah', 'Edit', 'Hapus']))
                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <a href="{{ url('/eppgbm') }}" class="btn btn-sm btn-secondary float-start">
                                <span data-feather="arrow-left"></span>
                            </a>
                            <h4 class="card-category">{{ $method }} Orang Tua Asuh</h4>
                        </div>
                        <div class="card-body">
                            @include('layout.partials.messages')
                            <form method="post" action="{{ route('eppgbm.perform', ['method' => $method]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="nik" id="nik" value="{{ (!isset($data) && ($method == 'Tambah')) ? old('nik') : $data->nik }}" placeholder="2172xxxxxxxxxx" required="required" autofocus onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="16">
                                    <label for="floatingNIP">NIK</label>
                                    @if ($errors->has('nik'))
                                        <span class="text-danger text-left">{{ $errors->first('nik') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <input type="hidden" class="form-control" name="nama" id="nama1" value="{{ (!isset($data) && ($method == 'Tambah')) ? old('nama') : $data->nama }}" placeholder="Nama">
                                    <input type="text" class="form-control" id="nama" value="{{ (!isset($data) && ($method == 'Tambah')) ? old('nama') : $data->nama }}" placeholder="Nama" disabled>
                                    <label for="nama">Nama</label>
                                    @if ($errors->has('nama'))
                                        <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="orang_tua_asuh" value="{{ (!isset($data) && ($method == 'Tambah')) ? old('orang_tua_asuh') : $data->orang_tua_asuh }}" placeholder="Orang Tua Asuh">
                                    <label for="floatingNama">Nama Orang Tua Asuh</label>
                                    @if ($errors->has('orang_tua_asuh'))
                                        <span class="text-danger text-left">{{ $errors->first('orang_tua_asuh') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-floating mb-3">
                                    <textarea class="form-control" name="keterangan" placeholder="Keterangan" style="height: 100px">{{ (!isset($data) && ($method == 'Tambah')) ? old('keterangan') : $data->keterangan }}</textarea>
                                    <label for="floatingNama">Keterangan</label>
                                    @if ($errors->has('keterangan'))
                                        <span class="text-danger text-left">{{ $errors->first('keterangan') }}</span>
                                    @endif
                                </div>

                                @if(isset($data) && ($method != 'Tambah'))
                                    <div class="form-group form-floating mb-3">
                                        <input type="hidden" class="form-control" name="id" value="{{ $data->id }}" placeholder="ID" required="required" autofocus>
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
                                <a href="{{ url('/eppgbm/tambah') }}" class="btn btn-sm btn-success float-end">
                                    <span data-feather="heart"></span>
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
                                            <th>Orang Tua Asuh</th>
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
                                                    <td>
                                                        {{ date("d-m-Y", strtotime($value->tgl_pengukuran)) }}
                                                    </td>
                                                    <td>{{ $value->asuhan->orang_tua_asuh ?? "-" }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-between gap-1">
                                                            <a href="{{ route('eppgbm.edit', ['id' => $value->id]) }}" class="btn btn-sm btn-pink text-light">
                                                                <span data-feather="heart"></span>
                                                            </a>
                                                            <a href="{{ route('eppgbm.hapus', ['id' => $value->id]) }}"  class="btn btn-sm btn-danger disabled">
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