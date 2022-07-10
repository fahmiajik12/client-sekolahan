@extends('layouts/main-admin')

@if  (session()->get('userLogged')->type != 'guru')
@section('title', 'Dashboard Admin')
@endif

@section('title', 'Dashboard Guru')

@section('container')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo, {{ ucfirst(session()->get('userLogged')->type) }}</h1>
    </div>
    <div class="row">
        @if  (session()->get('userLogged')->type != 'guru')
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('guru.index') }}" style="text-decoration:none;">
                <div class="card border-left-danger shadow h-100 py-2 bg-danger">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-white">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-white"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('kelas.index') }}" style="text-decoration:none;">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-white">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-landmark fa-2x text-white"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @if  (session()->get('userLogged')->type != 'guru')
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('siswa.index') }}" style="text-decoration:none;">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-white">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('mapel.index') }}" style="text-decoration:none;">
                <div class="card border-left-info shadow h-100 py-2 bg-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Mata Pelajaran</div>
                            <div class="h5 mb-0 font-weight-bold text-white">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-white"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if  (session()->get('userLogged')->type != 'guru')
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('jadwal.index') }}" style="text-decoration:none;">
                <div class="card border-left-secondary shadow h-100 py-2 bg-secondary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Jadwal Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-white">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-white"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="/rekap-presensi" style="text-decoration:none;">
                <div class="card border-left-primary shadow h-100 py-2 bg-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Rekap Presensi</div>
                            <div class="h5 mb-0 font-weight-bold text-white">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-white"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif     
    </div>
</div>
@endsection