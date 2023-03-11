@extends('layout.master')

@section('title', "Dashboard :: Dashboard Stunting")

@section('content')
    <div class="container-fluid py-5">
        <div class="d-flex flex-column gap-5">
            <div class="row row-cols-2 row-cols-md-4 g-5">
                @foreach($nsebarankec as $key => $value)
                    <div class="col">
                        <div class="card card-body text-bg-teal bg-gradient shadow h-100">
                            <h4>{{$key}}</h4>
                            <h1 class="align-self-end">{{$value}}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('layout.partials.peta-sebaran')
            @include('layout.partials.tabel-sebaran')
        </div>
    </div>
    <div class="modal fade" id="modalDataBalita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="table-data-1" class="table display table-sm table-striped" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Posyandu</th>
                                <th>Puskesmas</th>
                                <th>Berat</th>
                                <th>Tinggi</th>
                                <th>TB/U</th>
                                <th>Tanggal Pengukuran</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection