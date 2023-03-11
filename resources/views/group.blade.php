@extends('layout.master')

@section('title', "Pengguna :: Dashboard Stunting")

@section('content')
    <div class="container-fluid pt-3 vh-100">
        <div class="row g-3">
            @if(in_array($method, ['Tambah', 'Edit', 'Hapus']))
                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <a href="{{ url('/group') }}" class="btn btn-sm btn-secondary float-start">
                                <span data-feather="arrow-left"></span>
                            </a>
                            <h4 class="card-category">{{ $method }} Group Akses</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('group.perform', ['method' => $method]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ (!isset($group) && ($method == 'Tambah')) ? old('nama') : $group->nama }}" required="required" autofocus>
                                    <label for="floatingNIP">Nama Group</label>
                                    @if ($errors->has('nama'))
                                        <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>

                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Modul</th>
                                            <th>Lihat</th>
                                            <th>Tambah</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                            <th>Simpan</th>
                                            <th>Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($lsAkses = isset($group->lsakses) ? json_decode($group->lsakses) : '')
                                        <tr>
                                            <td>Pengguna</td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[pengguna][]" {{ isset($lsAkses->pengguna) && in_array('lihat',$lsAkses->pengguna) ? 'checked': ''}} value="lihat"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[pengguna][]" {{ isset($lsAkses->pengguna) && in_array('tambah',$lsAkses->pengguna) ? 'checked': ''}} value="tambah"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[pengguna][]" {{ isset($lsAkses->pengguna) && in_array('edit',$lsAkses->pengguna) ? 'checked': ''}} value="edit"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[pengguna][]" {{ isset($lsAkses->pengguna) && in_array('hapus',$lsAkses->pengguna) ? 'checked': ''}} value="hapus"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[pengguna][]" {{ isset($lsAkses->pengguna) && in_array('perform',$lsAkses->pengguna) ? 'checked': ''}} value="perform"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Group</td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[group][]" {{ isset($lsAkses->group) && in_array('lihat',$lsAkses->group) ? 'checked': ''}} value="lihat"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[group][]" {{ isset($lsAkses->group) && in_array('tambah',$lsAkses->group) ? 'checked': ''}} value="tambah"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[group][]" {{ isset($lsAkses->group) && in_array('edit',$lsAkses->group) ? 'checked': ''}} value="edit"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[group][]" {{ isset($lsAkses->group) && in_array('hapus',$lsAkses->group) ? 'checked': ''}} value="hapus"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[group][]" {{ isset($lsAkses->group) && in_array('perform',$lsAkses->group) ? 'checked': ''}} value="perform"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>EPPGBM</td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[eppgbm][]" {{ isset($lsAkses->eppgbm) && in_array('lihat',$lsAkses->eppgbm) ? 'checked': ''}} value="lihat"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[eppgbm][]" {{ isset($lsAkses->eppgbm) && in_array('tambah',$lsAkses->eppgbm) ? 'checked': ''}} value="tambah"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[eppgbm][]" {{ isset($lsAkses->eppgbm) && in_array('edit',$lsAkses->eppgbm) ? 'checked': ''}} value="edit"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[eppgbm][]" {{ isset($lsAkses->eppgbm) && in_array('hapus',$lsAkses->eppgbm) ? 'checked': ''}} value="hapus"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[eppgbm][]" {{ isset($lsAkses->eppgbm) && in_array('perform',$lsAkses->eppgbm) ? 'checked': ''}} value="perform"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[eppgbm][]" {{ isset($lsAkses->eppgbm) && in_array('upload',$lsAkses->eppgbm) ? 'checked': ''}} value="upload" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>ELSIMIL</td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[elsimil][]" {{ isset($lsAkses->elsimil) && in_array('lihat',$lsAkses->elsimil) ? 'checked': ''}} value="lihat" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[elsimil][]" {{ isset($lsAkses->elsimil) && in_array('tambah',$lsAkses->elsimil) ? 'checked': ''}} value="tambah" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[elsimil][]" {{ isset($lsAkses->elsimil) && in_array('edit',$lsAkses->elsimil) ? 'checked': ''}} value="edit" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[elsimil][]" {{ isset($lsAkses->elsimil) && in_array('hapus',$lsAkses->elsimil) ? 'checked': ''}} value="hapus" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[elsimil][]" {{ isset($lsAkses->elsimil) && in_array('perform',$lsAkses->elsimil) ? 'checked': ''}} value="perform"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[elsimil][]" {{ isset($lsAkses->elsimil) && in_array('upload',$lsAkses->elsimil) ? 'checked': ''}} value="upload" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>EKOHOT</td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[ekohot][]" {{ isset($lsAkses->ekohot) && in_array('lihat',$lsAkses->ekohot) ? 'checked': ''}} value="lihat" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[ekohot][]" {{ isset($lsAkses->ekohot) && in_array('tambah',$lsAkses->ekohot) ? 'checked': ''}} value="tambah" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[ekohot][]" {{ isset($lsAkses->ekohot) && in_array('edit',$lsAkses->ekohot) ? 'checked': ''}} value="edit" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[ekohot][]" {{ isset($lsAkses->ekohot) && in_array('hapus',$lsAkses->ekohot) ? 'checked': ''}} value="hapus" disabled></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[ekohot][]" {{ isset($lsAkses->ekohot) && in_array('perform',$lsAkses->ekohot) ? 'checked': ''}} value="perform"></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[ekohot][]" {{ isset($lsAkses->ekohot) && in_array('upload',$lsAkses->ekohot) ? 'checked': ''}} value="upload" disabled></td>
                                        </tr>
                                         <tr>
                                            <td>Upload</td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[dashboard][]" {{ isset($lsAkses->dashboard) && in_array('upload',$lsAkses->dashboard) ? 'checked': ''}} value="upload"></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[upload][]" {{ isset($lsAkses->upload) && in_array('hapusUpload',$lsAkses->upload) ? 'checked': ''}} value="hapusUpload"></td>
                                            <td></td>
                                            <td class="text-center"><input type="checkbox" name="lsakses[upload][]" {{ isset($lsAkses->upload) && in_array('performUpload',$lsAkses->upload) ? 'checked': ''}} value="performUpload"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if(isset($group) && ($method != 'Tambah'))
                                    <div class="form-group form-floating mb-3">
                                        <input type="hidden" class="form-control" name="id" value="{{ $group->id }}" placeholder="ID" required="required" autofocus>
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
                                {{ $method }} Group Akses
                                <a href="{{ url('/group/tambah') }}" class="btn btn-sm btn-success float-end">
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
                                            <th>Nama Group</th>
                                            <th width="60%">Akses</th>
                                            <th width="5%">Aksi</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($group)
                                            @foreach($group as $key => $value)
                                                <tr>
                                                    <td>{{$key +1}}</td>
                                                    <td>{{ $value->nama }}</td>
                                                    <td class="text-center">{{ $value->lsakses }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-between gap-1">
                                                            <a href="{{ route('group.edit', ['id' => $value->id]) }}" class="btn btn-sm btn-primary">
                                                                <span data-feather="edit"></span>
                                                            </a>
                                                            <a href="{{ route('group.hapus', ['id' => $value->id]) }}"  class="btn btn-sm btn-danger">
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
                     }else{
                        alert(retval['message'])
                        document.getElementById('nama').value = '';
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