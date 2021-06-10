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
        <h4>Data Siswa</h4>
        <button class="btn btn-success btn-sm modal-add-siswa">
            <i class="fa fa-plus"></i> Tambah Data</button>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success_import'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered display" id="tableSiswa" style="width: 100%">
                        <thead>
                            <th>Nama</th>
                            <th class="text-center">NIS</th>
                            <th class="text-center">NISN</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal-form">
    <div class="modal-body">
        <div class="modal-head">
            <span class="modal-title">Tambah data</span>
            <span class="close close-modal">&times;</span>
        </div>
        <button class="btn btn-success csv">Import format CSV</button>
        <a class="btn btn-primary manual" href="{{ url('') }}/siswa/tambah-data">Tambah Data Manual</a>
    </div>
</div>
<!-- / modal -->

@endsection
@section('scripts')
    <script>
        $(function() {
            $('#tableSiswa').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('') }}/siswa/data-siswa",
                columns: [
                    {data: 'nama', name: 'nama'},
                    {data: 'nis', name: 'nis', className: 'text-center'},
                    {data: 'nisn', name: 'nisn', className: 'text-center'},
                    {data: 'kelas', name: 'kelas', className: 'text-center'},
                    {data: 'actions', name: 'actions', className: 'text-center', orderable: false, searchable: false}
                ]
            })

            $('.modal-add-siswa').click(function() {
                if($('.modal-form').css('display') == 'none') {
                    $('.modal-form').css('display', 'flex')
                }
            })
            $('.close-modal').click(function() {
                $('.modal-form').css('display', 'none')
            })
            $('.csv').click(function() {
                $('.csv').hide()
                $('.manual').hide()
                $('.close-modal').hide()
                $('.modal-body').prepend(`
                    <form class="form-add-csv" action="{{ url('') }}/siswa/upload" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control" name="upload_file">
                        <button type="submit" class="btn btn-primary">Import</button>
                        <a class="cancel-csv btn btn-dark">cancel</a>
                    </form>
                `)
                $('.modal-title').html('Input data .csv')
            })
            $(document).on('click', '.cancel-csv', function() {
                $('.csv').show()
                $('.manual').show()
                $('.form-add-csv').hide()
                $('.close-modal').show()
                $('.modal-title').html('Tambah data')
            })
        })
    </script>
@endsection
