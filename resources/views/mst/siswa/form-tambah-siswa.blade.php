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
    <small>Dashboard / siswa / tambah-data</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Tambah data Siswa</h4>
    </div>
    <i><small class="text-info">* isi semua data dengan benar</small></i>
    <br>
    <span class="text-info"><small>* Data siswa</small></span>
    <div class="card-body">
        <div class="card shadow" style="margin-top: 0;">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ url('') }}/siswa/store" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <input autocomplete="off" placeholder="Nama" name="nama" autofocus required type="text" id="nama">
                            </div>
                            <div class="col-sm-4">
                                <input autocomplete="off" placeholder="NIS" required name="nis" type="text">
                            </div>
                            <div class="col-sm-4">
                                <input autocomplete="off" placeholder="NISN" required type="text" name="nisn">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span class="text-info"><small>* Informasi siswa</small></span>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="nama">Jenis Kelamin : *</label>
                                <select name="jk" id="kelas">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="nama">Kelas : *</label>
                                <select name="kelas" id="kelas">
                                    @foreach ($kelas as $item)
                                    <option value="{{ $item->kelas }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="nama">Jurusan : *</label>
                                <select name="jurusan" id="kelas">
                                    @foreach ($jurusan as $item)
                                    <option value="{{ $item->id_jurusan }}">{{ $item->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <label for="">Tanggal Lahir : *</label>
                                <input autocomplete="off" required type="date" name="tglLahir">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Kota Lahir : *</label>
                                <input autocomplete="off" required type="text" name="kota">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span class="text-info"><small>* Informasi detail</small></span>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <input autocomplete="off" placeholder="Agama" required type="text" name="agama">
                            </div>
                            <div class="col-sm-2">
                                <input autocomplete="off" placeholder="Dusun" required type="text" name="dusun">
                            </div>
                            <div class="col-sm-2">
                                <input autocomplete="off" placeholder="RT" required type="number" name="rt">
                            </div>
                            <div class="col-sm-2">
                                <input autocomplete="off" placeholder="RW" required type="number" name="rw">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px; margin-bottom: 10px">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <input autocomplete="off" placeholder="Kelurahan" required type="text" name="kelurahan">
                            </div>
                            <div class="col-sm-3">
                                <input autocomplete="off" placeholder="Kecamatan" required type="text" name="kecamatan">
                            </div>
                            <div class="col-sm-3">
                                <input autocomplete="off" placeholder="Transportasi" required type="text" name="transportasi">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <input autocomplete="off" placeholder="Kode pos" required type="number" name="pos">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="display: flex; flex-direction: column; margin-bottom: 20px">
                                <label for="alamat">Tulis kembali alamat (Alamat lengkap) : *</label>
                                <textarea name="alamat" id="alamat" cols="80" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('') }}/siswa" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
