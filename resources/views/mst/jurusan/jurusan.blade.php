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
    <small>Dashboard / master data / jurusan</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Jurusan</h4>
        <button class="btn btn-success btn-sm modal-add-siswa">
            <i class="fa fa-plus"></i> Tambah Data</button>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success_add'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('success_edit'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('success_del'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @endif
        <table class="table table-bordered display" id="tableJurusan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Jurusan</th>
                    <th>Jurusan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusan as $idx => $item)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $item->id_jurusan }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td class="text-center">
                        <a href="#" id="edit{{ $item->id }}" class="btn btn-warning btn-sm edit">Edit</a>
                        <a href="{{ url('') }}/jurusan/delete/{{ $item->id }}" onclick="return confirm('Lanjutkan menghapus data?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal-form edit{{ $item->id }}">
                    <div class="modal-body">
                        <div class="modal-head">
                            <span class="modal-title">Tambah jurusan</span>
                            <span class="close close-modal">&times;</span>
                        </div>
                        <form action="{{ url('') }}/jurusan/update/{{ $item->id }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <input type="text" placeholder="id jurusan" autocomplete="off" name="id_jurusan" value="{{ $item->id_jurusan }}">
                            </div>
                            <div class="form-group" style="margin-top: -20px">
                                <input type="text" placeholder="jurusan" name="jurusan" autocomplete="off" value="{{ $item->jurusan }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Sumbit</button>
                        </form>
                    </div>
                </div>
                <!-- / modal -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal-form add">
    <div class="modal-body">
        <div class="modal-head">
            <span class="modal-title">Tambah jurusan</span>
            <span class="close close-modal">&times;</span>
        </div>
        <form action="{{ url('') }}/jurusan/add" method="post">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="id jurusan" name="id_jurusan">
            </div>
            <div class="form-group" style="margin-top: -20px">
                <input type="text" placeholder="jurusan" name="jurusan">
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
            if($('.modal-form.add').css('display') == 'none') {
                $('.modal-form.add').css('display', 'flex')
            }
        })

        $('.close-modal').click(function() {
            $('.modal-form').css('display', 'none')
        })

        $('.edit').click(function(e) {
            e.preventDefault()
            var id_modal = $(this).attr('id')
            $(`.${id_modal}`).css('display', 'flex')
        })
    </script>
@endsection
