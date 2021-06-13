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
        <h4>Tambah Data Transaksi</h4>
    </div>
    <div class="card-body">
        <div class="card shadow">
            <div class="message" style="margin-bottom: 20px">
                <span><h6>Note : </h6></span>
                <span class="text-info"><small>* Isi informasi dengan benar</small></span>
                <br>
                <span class="text-info"><small>* Set Bulan dan Tahun dengan benar</small></span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ url('') }}/transaksi/update/{{ $id }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Nomor transaksi : *</label>
                                <input type="text" name="no_transaksi" disabled> <!-- disabled input -->
                                <input type="text" name="no_transaksi" hidden> <!-- hidden input -->
                            </div>
                            <div class="col-sm-4" style="margin-left: 70px">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="">Bulan : *</label>
                                        <select name="bulan" id="">
                                            @foreach ($bulan as $item)
                                                <option value="{{ $item->id }}">{{ $item->bulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Tahun : *</label>
                                        <input type="number" name="tahun" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Siswa : *</label>
                                <input type="text" value="{{ $siswa->first()->nama }}" disabled>
                                <input type="text" name="siswa" value="{{ $siswa->first()->id }}" hidden>
                            </div>
                            <div class="col-sm-4" style="margin-left: 70px">
                                <label for="">Tagihan : *</label>
                                <input type="text" value="Rp.0,-" class="tagihan" disabled>
                            </div>
                        </div>

                        <!-- input spp hidden -->
                        <input type="number" class="spp_harga" hidden name="spp">

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">NIS : *</label>
                                <input type="text" class="nis" value="{{ $siswa->first()->nis }}" disabled>
                            </div>

                            <!-- jika siswa sudah pernah membayar -->
                            @if ($siswa->first()->transaksi != null)
                                <div class="col-sm-4 dibayar" style="margin-left: 70px">
                                    <label for="">Telah membayar : *</label>
                                    <input type="number" name="dibayar" class="jumlah" value="{{ $siswa->first()->transaksi->bayar }}">
                                </div>
                            <!-- jika siswa belum pernah membayar -->
                            @elseif ($siswa->first()->transaksi == null)
                                <div class="col-sm-4 dibayar" style="margin-left: 70px">
                                    <label for="">Jumlah dibayar : *</label>
                                    <input type="number" name="dibayar" class="jumlah" placeholder="Rp.0,-">
                                </div>
                            @endif
                            <!-- // -->

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">NISN : *</label>
                                <input type="text" class="kelas" value="{{ $siswa->first()->nisn }}" disabled>
                            </div>
                            <div class="col-sm-4" style="margin-left: 70px">
                                <label for="">Sisa Tagihan : *</label>
                                <input type="text" class="sisa_disabled" name="sisa_bayar" value="Rp.{{ $siswa->first()->transaksi->sisa_bayar }}.00,-" disabled> <!-- disabled input -->
                                <input type="text" class="sisa_hidden" name="sisa_bayar" value="0" hidden> <!-- hidden input -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary btn-block">Sumbit</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{ url('') }}/transaksi" class="cancel btn btn-secondary btn-block">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function() {
            // create transaksi unique code
            var generate = Math.round(Math.random() * (100, 1000));
            $('input[name=no_transaksi]').attr('value', generate+'TRS-'+Date.now())

            // akumulasi tagihan
            $.get(`{{ url('') }}/transaksi/get-harga-spp`, function(res) {
                res.forEach(function(val) {
                    var tagihan = val.harga_spp - (val.harga_spp * val.diskon / 100)
                    $('.sisa_hidden').attr('value', tagihan)
                    // Masukan harga spp ke input spp
                    $('.spp_harga').attr('value', tagihan)

                    //
                    $('.tagihan').attr('value', `Rp.${tagihan}.00,-`)

                    $('.dibayar').on('keyup', '.jumlah', function(e) {
                        var jumlah = $('.jumlah').val()
                        var sisa = tagihan - jumlah
                        $('.sisa_disabled').attr('value', `Rp.${sisa}.00,-`)
                        $('.sisa_hidden').attr('value', sisa)
                    })
                })
            })

            var date = new Date()
            $('input[name=tahun]').attr('value', date.getFullYear())
        })
    </script>
@endsection
