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
    .status-btn {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .status-btn button {
        width: 50%;
        height: 35px;
        border: 1px solid rgb(0, 181, 213);
        background-color: rgb(0, 161, 189);
        border-radius: 5px;
        color: #FFF;
    }
    .status-btn button:hover {
        background-color: rgb(0, 181, 213);
    }
</style>
<div class="menu-position">
    <small>Dashboard / siswa</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Data Transaksi</h4>
        <button class="btn btn-success add-transaksi">
            <i class="fa fa-plus"></i> Tambah Data</button>
    </div>

    <div class="status-btn">
        <button class="pay">Data siswa yang telah membayar</button>
        <button class="unpay">Data siswa yang belum membayar</button>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success_add'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('success_del'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('success_edit'))
        <div class="alert alert-warning" role="alert">
            {{ $message }}
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Table Paid -->
                    <div class="table-paid">
                    <table class="table table-bordered display" id="tableTransaksiPaid" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Telah dibayar</th>
                                <th class="text-center">SPP</th>
                                <th class="text-center">Status pembayaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">{{ $item->siswa->first()->nis }}</td>
                                    <td class="text-center">{{ $item->bayar }}</td>
                                    <td class="text-center">{{ $item->spp }}</td>
                                    <td class="text-center">
                                        @if ($item->is_paid == 1)
                                            <span class="paid">Paid</span>
                                        @elseif ($item->is_pending == 1)
                                            <span class="pending">Pending</span>
                                        @else
                                            <span class="unpaid">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-warning btn-sm">Edit Pembayaran</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- Table Unpaid -->
                    <div class="table-unpaid" hidden>
                    <table class="table table-bordered display" id="tableTransaksiUnpaid" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Telah dibayar</th>
                                <th class="text-center">SPP</th>
                                <th class="text-center">Status pembayaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unpaid as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">{{ $item->nis }}</td>
                                <td class="text-center">0</td>
                                <td class="text-center">{{ $spp }}</td>
                                <td class="text-center"><span class="unpaid">Unpaid</span></td>
                                <td class="text-center">
                                    <a href="{{ url('') }}/transaksi/edit/{{ $item->id }}" class="btn btn-warning btn-sm">Edit Pembayaran</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#tableTransaksiPaid').DataTable({})
            $('#tableTransaksiUnpaid').DataTable({})

            $('.unpay').click(() => {
                $('.table-unpaid').removeAttr('hidden');
                $('.table-paid').attr('hidden', 'on');
            })

            $('.pay').click(() => {
                $('.table-paid').removeAttr('hidden');
                $('.table-unpaid').attr('hidden', 'on');
            })

            $('.add-transaksi').click(function() {
                window.location.href = `{{ url('') }}/transaksi/add`
            })
        })
    </script>
@endsection
