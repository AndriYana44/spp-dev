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
    <small>Dashboard / jurusan</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Jurusan</h4>
        <button class="btn btn-success btn-sm modal-add-siswa">
            <i class="fa fa-plus"></i> Tambah Data</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered display" id="tableJurusan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusan as $idx => $item)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal-form">
    <div class="modal-body">
        <div class="modal-head">
            <span class="modal-title">Tambah jurusan</span>
            <span class="close close-modal">&times;</span>
        </div>
        <form action="{{ url('') }}/jurusan/add" method="post">
            @csrf
            <div class="form-group">
                <label for="jurusan">Jurusan : *</label>
                <input type="text" class="form-control" name="jurusan">
            </div>
            <button type="submit" class="btn btn-primary">Sumbit</button>
        </form>
    </div>
</div>
<!-- / modal -->

@endsection

@section('scripts')
    <script>
        $('#tableJurusan').DataTable({});
        $('.modal-add-siswa').click(function() {
            if($('.modal-form').css('display') == 'none') {
                $('.modal-form').css('display', 'flex')
            }
        })
        $('.close-modal').click(function() {
            $('.modal-form').css('display', 'none')
        })
    </script>
@endsection
