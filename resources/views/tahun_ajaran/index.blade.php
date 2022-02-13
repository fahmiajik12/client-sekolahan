@extends('layouts/main-admin')

@section('title', 'Tahun Ajaran')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">TAHUN AJARAN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tahun Ajaran</li>
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
                    <th>TAHUN AJARAN</th>
                    <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $item->tahun_ajaran }}</td>
                        <td class="text-center">
                            <a href="{{ route('tahun-ajaran.edit', $item->id) }}">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                            </a>
                            <form id="delete-user-{{$item->id}}" action="/tahun-ajaran/{{$item->id}}" method="post" style="display: inline;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data-admin_length").append('<a  href="{{ route('tahun-ajaran.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection