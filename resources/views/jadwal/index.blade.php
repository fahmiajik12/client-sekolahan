@extends('layouts/main-admin')

@section('title', 'Jadwal')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">JADWAL</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Jadwal</li>
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
                    <th>KELAS</th>
                    <th>MAPEL</th>
                    <th>GURU PENGAMPU</th>
                    <th>HARI</th>
                    <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($jadwals))
                        @foreach ($jadwals as $key => $jadwal)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $jadwal->nama_kelas }}</td>
                                <td>{{ $jadwal->nama_mapel }}</td>
                                <td>{{ $jadwal->nama }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td class="text-center">
                                    @if(session()->get('userLogged')->type=='admin')
                                    <a href="{{ route('jadwal.edit', $jadwal->id) }}">
                                        <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <form id="delete-jadwal-{{$jadwal->id}}" action="/jadwal/{{$jadwal->id}}" method="post"
                                        style="display: inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @if(session()->get('userLogged')->type=='guru')
                                    <a href="/get-siswa/{{ $jadwal->id }}">
                                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Presensi">
                                            <i class="fa fa-fingerprint"></i>
                                        </button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
@if(session()->get('userLogged')->type=='admin')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data-admin_length").append('<a  href="{{ route('jadwal.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
    @endif
@endsection