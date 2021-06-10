@extends('layouts.main_layout')
@section('content')
<style>
    .menu-position {
        margin-top: 2rem;
        position: absolute;
        left: 0;
        height: 40px;
        width: 100%;
        background-color: rgb(225, 225, 225);
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 40px;
        color: #777;
    }
    .card {
        margin-top: 5.5rem;
        padding: 20px;
        width: 100%;
        height: max-content;
    }
    .card-body {
        padding-top: 20px;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }
    .card-header button {
        position: absolute;
        right: 20px;
    }
</style>
<div class="menu-position">
    <small>Dashboard / siswa</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Tambah data Siswa</h4>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="nama">Nama : *</label>
                            <input type="text" id="nama" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="nama">NIS : *</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="nama">NISN : *</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-sm-2">
                            <label for="nama">Kelas : *</label>
                            <select name="kelas" id="kelas" class="form-control">
                                @foreach ($kelas as $item)
                                <option value="{{ $item->kelas }}">{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="nama">Jurusan : *</label>
                            <select name="kelas" id="kelas" class="form-control">
                                @foreach ($jurusan as $item)
                                <option value="{{ $item->jurusan }}">{{ $item->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="nama">Jenis Kelamin : *</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="">Tanggal Lahir : *</label>
                            <input type="date" class="form-control" name="tglLahir">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Kota Lahir : *</label>
                            <input type="text" class="form-control" name="kota">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-sm-3">
                            <label for="">Agama : *</label>
                            <input type="text" name="agama" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Alamat : *</label>
                            <input type="text" name="alamat" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Dusun : *</label>
                            <input type="text" name="dusun" class="form-control">
                        </div>
                        <div class="col-sm-1">
                            <label for="">RT : *</label>
                            <input type="number" name="rt" class="form-control">
                        </div>
                        <div class="col-sm-1">
                            <label for="">RW : *</label>
                            <input type="number" name="rw" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px; margin-bottom: 30px">
                        <div class="col-sm-3">
                            <label for="">Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Kecamatan : *</label>
                            <input type="text" name="kecamatan" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Transportasi : *</label>
                            <input type="text" name="transportasi" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label for="">POS : *</label>
                            <input type="number" name="pos" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('') }}/siswa" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
