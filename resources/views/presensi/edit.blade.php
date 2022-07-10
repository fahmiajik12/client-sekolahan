@extends('layouts/main-admin')

@section('title', 'Edit Presensi')

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
                <li class="breadcrumb-item active">Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('presensi.update',$presensi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">                    
                    <div class="form-group">
                        <label for="exampleInputJK">Presensi</label>
                        <select class="form-control" name="siswa_id" id="siswa_id" required>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}" @if ($siswa->id == $presensi->siswa_id)
                                    selected=""
                                @endif>{{ $siswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Status</label>
                         <select class="form-control" name="status" id="status" required>
                            <option value="hadir" @if ($presensi->status == 'hadir')
                                selected=""
                            @endif>Hadir</option>
                            <option value="izin" @if ($presensi->status == 'izin')
                                selected=""
                            @endif>Izin</option>
                            <option value="sakit" @if ($presensi->status == 'sakit')
                                selected=""
                            @endif>Sakit</option>
                            <option value="alpha" @if ($presensi->status == 'alpha')
                                selected=""
                            @endif>Alpha</option>
                        </select>                                                        
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