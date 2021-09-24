@extends('layouts.main_layout')
@section('content')
<div class="menu-position">
    <small>Dashboard / Transaksi / Data periode</small>
</div>

<div class="card">
    <div class="card-header">
        <h4>Data Periode</h4>
        <style>
            a.add-periode-data {
                position: absolute;
                right: 10px;
            }
        </style>
        <a href="{{ url('') }}/transaksi/set-harga-spp" class="btn btn-success btn-sm add-periode-data">
            <i class="fa fa-plus"></i> Tambah Data</a>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        <table class="tableDataPeriode table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Harga SPP</th>
                    <th class="text-center">Potongan</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Bulan</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $idx => $item)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td class="text-center">Rp. {{ number_format($item->harga_spp,2,',','.') }}</td>
                    <td class="text-center">{{ $item->diskon }}%</td>
                    <td class="text-center">Rp. {{ number_format($item->harga_spp - ($item->harga_spp * $item->diskon / 100),2,',','.') }}</td>
                    <td class="text-center">{{ $item->bulan->bulan }}</td>
                    <td class="text-center">{{ $item->tahun->tahun }}</td>
                    <td class="text-center">
                        <a href="{{ url('') }}/transaksi/data-periode/edit/{{ $item->id }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('') }}/transaksi/data-periode/delete/{{ $item->id }}" onclick="return confirm('Lanjutkan menghapus data?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('.tableDataPeriode').DataTable()
    </script>
@endsection
