@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    </div>
    <div class="row">
    <!-- Card Transaksi Baru -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kriteria</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Transaksi Retur -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Alternatif</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Reseller & Agent -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                    <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">2</div>
                    </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection