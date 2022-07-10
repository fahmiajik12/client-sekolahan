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
            <form role="form" method="post" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">                    
                    <div class="form-group">
                        <label for="exampleInputJK">NAMA</label>
                        <select class="form-control" name="siswa_id" id="siswa_id" required>
                            <option value="">Pilih nama</option>
                            @foreach ($siswas as $key => $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                            @endforeach
                        </select>
                    <div class="form-group">
                        <label for="exampleInputJK">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Pilih</option>
                            <option value="senin">Hadir</option>
                            <option value="selasa">Izin</option>
                            <option value="rabu">Sakit</option>
                            <option value="kamis">Alpha</option>
                        </select>
                    </div>                                       
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection