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
                                            <a href="" class="btn btn-info btn-sm detail" data-id="{{ $item->id }}">Detail</a>
                                        </td>
                                        @elseif ($item->is_pending == 1)
                                        <td class="text-center"><span class="pending">Pending</span></td>
                                        <td class="text-center">
                                            <a href="{{ url('') }}/transaksi/edit/{{ $item->siswa->id }}" class="btn btn-warning btn-sm">Edit Pembayaran</a>
                                            <a href="" class="btn btn-info btn-sm detail" data-id="{{ $item->id }}">Detail</a>
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

<style>
    .modal-detail {
        z-index: 9999;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, .5);
    }
    .modal-detail-content {
        width: 41%;
        height: 50%;
        border-radius: 8px;
        background-color: #fff;
        position: relative;
    }
    .modal-left {
        width: 50px;
        padding: 30px 10px 0 30px;
    }
    .modal-left img {
        width: 150px;
    }
    .modal-left .data-siswa {
        padding: 10px;
        margin-top: 10px;
        width: 350px;
        font-weight: 600;
    }
    .modal-right {
        position: absolute;
        right: 30px;
        top: 30px;
    }
    .close-btn {
        position: absolute;
        right: 15px;
        top: 10px;
        font-size: 25px;
        font-weight: 600;
        color: #666;
        cursor: pointer;
    }
    .close-btn:hover {
        color: #333;
    }
    .btn-close {
        position: absolute;
        width: 55px;
        height: 30px;
        border: none;
        color: #FFF;
        background-color: #666;
        border-radius: 5px;
        right: 15px;
        bottom: 10px;
        font-size: 14px;
    }
</style>

<!-- modal detail -->
<div class="modal-detail">
    <div class="modal-detail-content">
        <span class="close-btn">&times;</span>
        <button class="btn-close">Close</button>
        <div class="modal-left">
            <img src="{{ asset('') }}img/user.png" alt="...">
            <div class="data-siswa">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td class="nama"></td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td class="nis"></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td class="kelas"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal-right">
            <h4>Transaksi</h4>
            <table>
                <tr>
                    <td>Nomor Transaksi</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="transaksi"></td>
                </tr>
                <tr>
                    <td>Telah membayar</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="bayar"></td>
                </tr>
                <tr>
                    <td>Tagihan</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="tagihan"></td>
                </tr>
                <tr>
                    <td>Sisa bayar</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="sisa"></td>
                </tr>
                <tr>
                    <td>Status Pembayaran</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="status"></td>
                </tr>
            </table>
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

            $('.detail').click(function(e) {
                e.preventDefault()
                $('.modal-detail').css('display', 'flex')
                var id = $(this).data('id')
                $.get(`{{ url("") }}/transaksi/get-transaksi/${id}`, function(res) {
                    res.forEach(function(val) {
                        $('td.nama').html(val.siswa.nama)
                        $('td.nis').html(val.siswa.nis)
                        $('td.kelas').html(val.siswa.kelas)
                        $('td.transaksi').html(val.no_transaksi)
                        $('td.bayar').html(val.bayar)
                        $('td.tagihan').html(val.spp)
                        $('td.sisa').html(val.sisa_bayar)
                        if(val.sisa_bayar > 0) {
                            $('td.status').html('Belum lunas')
                        }else if(val.sisa_bayar <= 0) {
                            $('td.status').html('Sudah lunas')
                        }
                    })
                })
            })

            function closeModal(selector) {
                $(selector).click(function() {
                    $('.modal-detail').css('display', 'none');
                })
                return
            }

            closeModal('.btn-close')
            closeModal('.close-btn')
        })
    </script>
@endsection
