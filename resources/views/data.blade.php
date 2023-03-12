@extends('layout.master')

@section('title', "Data :: Dashboard Stunting")

@section('content')
    <div class="container-fluid pt-3">
        <div class="card h-100 shadow">
            <div class="card-header text-center">
                <h4 class="card-category">Data {{ $subpage }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead class="table-dark">
                        @if($headerData)
                            <tr>
                                <th>#</th>
                                @foreach($headerData as $key => $value)
                                    @if($value != "id")
                                        <th>{{ ucwords(str_replace("_"," ",$value)) }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    </thead>
                    <tbody class="small">
                        @if($lsData)
                            @foreach($lsData as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    @for($i=1; $i<$cHeader; $i++)
                                        <td>{{ $value[ $headerData[$i] ] }}</td>
                                    @endfor                   
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection