@extends('layouts/main-admin')

@section('title', 'Rekap Presensi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">REKAP PRESENSI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Rekap Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>NAMA</th>
                    <th>KELAS</th>
                    <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @if  ($rekapPresensi->data != null)
                        @foreach ($rekapPresensi->data as $key => $presensi)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $presensi->nama }}</td>
                                <td>{{ $presensi->nama_kelas }}</td>
                                <td>{{ $presensi->status }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts') 
@endsection