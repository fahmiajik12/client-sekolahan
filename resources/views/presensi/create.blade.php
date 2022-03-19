@extends('layouts/main-admin')

@section('title', 'Tambah Presensi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PRESENSI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Mata Pelajaran : <b>{{ $jadwal->mapel->nama_mapel }}</b></h5>
                    <h5>Guru Pengampu : <b>{{ $jadwal->guru->nama }}</b></h5>
                    <h5>Kelas : <b>{{ $jadwal->kelas->nama_kelas }}</b></h5>
                </div>
                <div class="col-md-6" style="text-align:right;">
                    <h6>Tahun Ajaran : <b>{{ $jadwal->tahun_ajaran->tahun_ajaran }} ({{ $jadwal->semester->semester }})</b></h6>    
                    <h6><b>{{ ucwords($jadwal->hari) }}, {{ $jadwal->jam_pelajaran }}</b></h6>    
                </div>
            </div>              
            <hr>
            <br>                      
            <form role="form" method="post" action="{{ route('presensi.store') }}">
                @csrf                
                <input type="hidden" name="kelas_id" value="{{ $jadwal->kelas->id }}">
                <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                <div class="form-group">
                    <label for="exampleInputPassword1">Pertemuan Ke-</label>
                    <input type="text" class="form-control" name="pertemuan" id="pertemuan" placeholder="ex : Pertemuan 1" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Materi Pertemuan</label>
                    <input type="text" class="form-control" name="materi_pertemuan" id="materi_pertemuan" placeholder="ex : Operasi Aritmatika" required>
                </div>                          
                <div class="form-group">
                    <label for="exampleInputPassword1">Silabus Materi</label>
                    <textarea class="form-control" name="silabus" id="silabus" cols="30" rows="10" required></textarea>
                </div>                          
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection