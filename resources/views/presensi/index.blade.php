@extends('layouts/main-admin')

@section('title', 'Presensi')

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
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>NAMA</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($presensi->data != null)
                    @foreach ($presensi->data as $key => $presensi)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $presensi->nama }}</td>
                        <td>
                            <form role="form" method="post" action="{{ route('presensi.store') }}">
                                <input type="hidden" name="siswa_id" value="{{ $presensi->id }}">
                                @csrf
                            <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Hadir">
                                    <label class="form-check-label" for="inlineRadio1">Hadir</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Izin">
                                    <label class="form-check-label" for="inlineRadio2">Izin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Sakit">
                                    <label class="form-check-label" for="inlineRadio1">Sakit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Alpha">
                                    <label class="form-check-label" for="inlineRadio2">Alpha</label>
                                </div>
                            </td>
                            <td>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </td>
                        </form>
                        </tr>
                        @endforeach
                        @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#data-admin_length").append('<a  href="{{ route('jadwal.index') }}"> <button type="button" class="btn btn-outline-primary ml-3">Kembali</button></a>');
    });
</script>
@endsection