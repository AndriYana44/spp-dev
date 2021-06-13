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
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .status-btn button {
        width: 49.8%;
        border: none;
        height: 35px;
        background-color: rgb(89, 186, 202);
        border-radius: 3px;
        color: #FFF;
    }
    .status-btn button:hover {
        background-color: rgb(65, 172, 191);
    }
    .status-btn #active {
        background-color: rgb(0, 161, 189);
    }
</style>
<div class="menu-position">
    <small>Dashboard / Transaksi / pembayaran spp</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Data Transaksi</h4>
    </div>

    <div class="status-btn">
        <button class="pay" id="active">Data siswa yang telah membayar</button>
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

                                        @if ($item->is_paid == 1)
                                        <td class="text-center"><span class="paid">Paid</span></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm" disabled>Edit Pembayaran</button>
                                            <a href="{{ url('') }}/transaksi/detail/{{ $item->id }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                        @elseif ($item->is_pending == 1)
                                        <td class="text-center"><span class="pending">Pending</span></td>
                                        <td class="text-center">
                                            <a href="{{ url('') }}/transaksi/edit/{{ $item->siswa->id }}" class="btn btn-warning btn-sm">Edit Pembayaran</a>
                                            <a href="{{ url('') }}/transaksi/detail/{{ $item->id }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                        @endif
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
                            @if ($item != null)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">{{ $item->nis }}</td>
                                <td class="text-center">0</td>
                                <td class="text-center">{{ $spp }}</td>
                                <td class="text-center"><span class="unpaid">Unpaid</span></td>
                                <td class="text-center">
                                    <a href="{{ url('') }}/transaksi/add/{{ $item->id }}" class="btn btn-success btn-sm">Pembayaran</a>
                                </td>
                            </tr>
                            @endif
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
                $('.unpay').attr('id', 'active');
                $('.pay').removeAttr('id');
            })

            $('.pay').click(() => {
                $('.table-paid').removeAttr('hidden');
                $('.table-unpaid').attr('hidden', 'on');
                $('.pay').attr('id', 'active');
                $('.unpay').removeAttr('id');
            })

            $('.add-transaksi').click(function() {
                window.location.href = `{{ url('') }}/transaksi/add`
            })
        })
    </script>
@endsection
