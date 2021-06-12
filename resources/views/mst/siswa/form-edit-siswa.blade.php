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
        <h4>Edit data Siswa</h4>
    </div>
    <i><small class="text-info">* isi semua data dengan benar</small></i>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                @foreach ($siswa as $item)
                <form action="{{ url('') }}/siswa/update/{{ $item->id }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-sm-4">

                            <label for="nama">Nama : *</label>
                            <input autocomplete="off" name="nama" value="{{ $item->nama }}" required type="text" id="nama">

                            <label for="nama">NIS : *</label>
                            <input autocomplete="off" required name="nis" value="{{ $item->nis }}" type="text">

                            <label for="nama">NISN : *</label>
                            <input autocomplete="off" required type="text" value="{{ $item->nisn }}" name="nisn">

                            <label for="nama">Kelas : *</label>
                            <select name="kelas" id="kelas">
                                @foreach ($kelas as $val)
                                <option value="{{ $val->kelas }}">{{ $val->kelas }}</option>
                                @endforeach
                            </select>

                            <label for="nama">Jurusan : *</label>
                            <select name="jurusan" id="kelas">
                                @foreach ($jurusan as $val)
                                <option value="{{ $val->id_jurusan }}">{{ $val->jurusan }}</option>
                                @endforeach
                            </select>

                            <label for="jk">Jenis Kelamin : *</label>
                            <select name="jk" id="jk">
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>

                            <label for="nama">Tanggal Lahir : *</label>
                            <input autocomplete="off" required type="text" value="{{ $item->tgl_lahir }}" name="tgl_lahir">

                            <div class="form-group" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('') }}/siswa" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
