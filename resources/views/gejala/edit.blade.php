@extends('layouts/main-admin')

@section('title', 'Edit Gejala')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">GEJALA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Gejala</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('gejala.update', $gejala->id) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kode Gejala</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="{{ $gejala->kode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Gejala</label>
                        <input type="text" class="form-control" name="gejala" id="gejala" value="{{ $gejala->gejala }}" required>
                    </div>
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