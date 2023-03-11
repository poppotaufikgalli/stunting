@extends('layout.master')

@section('title', "Upload File :: Dashboard Stunting")

@section('content')
    <div class="container-fluid pt-3 vh-100">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4 class="card-category">Upload File</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Contoh Format File</h5>
                    <div class="gap-2">
                        <a href="{{ route('dashboard.performDownloadCth', ['filename' => 'cth_izin.csv']) }}" type="button" class="btn btn-sm btn-info text-dark disabled">
                            <span data-feather="download"></span> Contoh Format ILSIMIL
                        </a>
                        <a href="{{ route('dashboard.performDownloadCth', ['filename' => 'cth_proyek.csv']) }}" type="button" class="btn btn-sm btn-info text-dark">
                            <span data-feather="download"></span> Contoh Format EPPBGM
                        </a>
                        <a href="{{ route('dashboard.performDownloadCth', ['filename' => 'cth_nib_kantor.csv']) }}" type="button" class="btn btn-sm btn-info text-dark disabled">
                            <span data-feather="download"></span> Contoh Format EKOHOT
                        </a>
                    </div>
                </div>
                <hr class="mb-3">
                <form method="post" action="{{route('upload.performUpload')}}" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="col-md-5 col-sm-12 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="nama_target_table" name="nama_target_table" aria-label="" required="required">
                                    <option selected disabled>Open this select menu</option>
                                    <option value="ilsimmil" disabled>ILSIMIL</option>
                                    <option value="eppgbm">EPPGBM</option>
                                    <option value="ekohot" disabled>EKOHOT</option>
                                </select>
                                <label for="nama_target_table">Nama Target Table</label>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 mb-3">
                            <div class="form-group form-floating">
                                <input type="file" class="form-control" name="filetoupload" value="" placeholder="Nama File" required="required" accept=".csv, .txt">
                                <label for="floatingNama">Upload File</label>
                                @if ($errors->has('nama_file'))
                                    <span class="text-danger text-left">{{ $errors->first('nama_file') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @include('layout.partials.messages')
                <table class="table table-sm table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th width="30%">Nama File</th>
                            <th width="30%">Nama Target Table</th>
                            <th width="10%">Jumlah Row</th>
                            <th width="15%">User</th>
                            <th>Aksi</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @if($dtupload)
                            @foreach($dtupload as $key => $value)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>{{ $value->nama_file }}</td>
                                    <td>{{ $value->nama_target_table }}</td>
                                    <td>{{ $value->jumlah_row }}</td>
                                    <td>{{ $value->nama_user }}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly gap-1">
                                            <a href="{{ route('dashboard.performDownload', ['filename' => $value->nama_file]) }}" type="button" class="btn btn-sm btn-success">
                                                <span data-feather="download"></span>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-id="{{ $value->id }}">
                                                <span data-feather="trash"></span>
                                            </button>
                                        </div>
                                    </td>                    
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="{{ route('upload.hapusUpload') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Menghapus File Upload</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="hapusHistory" checked disabled>
                              <label class="form-check-label" for="hapusHistory">Hapus History Upload</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="hapusFile" name="hapusFile" checked>
                                <label class="form-check-label" for="hapusFile">Hapus File di Server</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="hapusData" name="hapusData">
                                <label class="form-check-label" for="hapusData">Hapus Data Import</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const hapusModal = document.getElementById('hapusModal')
        hapusModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-bs-id')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            //const modalTitle = hapusModal.querySelector('.modal-title')
            const modalBodyInputId = hapusModal.querySelector('.modal-body input#id')

            //modalTitle.textContent = `New message to ${recipient}`
            modalBodyInputId.value = id
        });

        hapusModal.addEventListener('hidden.bs.modal', event => {
            const button = event.relatedTarget
            
            const modalBodyInputId = hapusModal.querySelector('.modal-body input#id')

            modalBodyInputId.value = ""
        })
    </script>
@stop