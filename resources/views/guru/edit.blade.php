@extends('layouts/main-admin')

@section('title', 'Edit Guru')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">GURU</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Guru</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('guru.update',$guru->id) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <h4>Data Guru</h4>
                    <div class="form-group">
                        <label for="exampleInputPassword1">User</label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            @foreach ($dataUsers as $users)
                                <option value="{{ $users->id }}" @if ($users->id == $guru->user_id)
                                    selected=""
                                @endif>{{ $users->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip" value="{{ $guru->nip }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $guru->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $guru->tempat_lahir }}" required>
                    </div>                    
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Tanggal Lahir</label>
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir" value="{{ $guru->tgl_lahir }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="laki-laki" @if ($guru->gender == 'laki-laki')
                                selected=""
                            @endif>Laki-Laki</option>
                            <option value="perempuan" @if ($guru->gender == 'perempuan')
                                selected=""
                            @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Nomor Telphone</label>
                        <input id="phone_number" type="number" class="form-control form-control-user @error('phone_number') is-invalid @enderror" name="phone_number" id="phoneValidation" value="{{ $guru->phone_number }}" placeholder="Nomor Telphone" required autocomplete="nik" style="-webkit-appearance: none;margin: 0;">
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $guru->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $guru->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pendidikan</label>
                        <textarea name="pendidikan" class="form-control" id="pendidikan" cols="30" rows="10" required>{{ $guru->pendidikan }}</textarea>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })
    });
    $('#phoneValidation').on('keyup', function () {
        this.value = this.value.replace(/[^0-9]/gi, '')
      });
</script>
@endsection