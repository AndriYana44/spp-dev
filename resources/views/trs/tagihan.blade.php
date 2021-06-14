@extends('layouts.main_layout')
@section('content')
    <style>
        .say {
            display: flex;
            flex-direction: column;
        }
        .card-body {
            display: flex;
            justify-content: center;
        }
        .periode {
            display: flex;
            flex-direction: column;
            width: 30%;
            justify-content: center;
            align-items: center;
        }
        @media only screen and (max-width: 600px) {
            .periode {
                width: 80%;
            }
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="say">
                <span class="card-title">Hallo, {{ $siswa->first()->nama }}</span>
                <span class="text-info">* Silahkan pilih periode tagihan, untuk melihat tagihan anda</span>
            </div>
        </div>
        <div class="card-body">
            <div class="periode">
                <select class="tahun" name="tahun" id="tahun">
                    @foreach ($tahun as $item)
                    <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                    @endforeach
                </select>
                <select class="bulan" name="bulan" id="bulan">
                    @foreach ($bulan as $item)
                    <option value="{{ $item->id }}">{{ $item->bulan }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary btn-block tagihan">Submit</button>
            </div>
        </div>
        <div class="card shadow" style="margin-top: 50px; height: 0; opacity: 0; overflow: hidden; transition: .5s;">
            <div class="info-tagihan" style="overflow: auto">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.tagihan').click(function() {
            var tahun = $('.tahun').on('option:selected').val()
            var bulan = $('.bulan').on('option:selected').val()
            var bulanTxt = $('.bulan option:selected').text()
            var id = `{{ $id }}`
            $.get(`{{ url('') }}/transaksi/getTagihan/${id}/${tahun}/${bulan}`, function(res) {

                if(res.length != 0) {
                    res.forEach(function(val) {
                        $('.shadow').css('opacity', '1');
                        $('.shadow').css('height', 'max-content');
                        $('.shadow').css('background-color', 'rgba(104, 173, 193, 0.41)')
                        $('.info-tagihan').children().remove()
                        $('.info-tagihan').append(`
                        <div class="informasi-tagihan text-center" style="margin-bottom: 10px;">
                            <h5>Berikut Informasi Tagihan</h5>
                        </div>
                        <hr>
                        <table class="table table-bordered" border="1" style="margin-top: 10px;">
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Bayar</th>
                                <th class="text-center">Tagihan</th>
                                <th class="text-center">Sisa tagihan</th>
                                <th class="text-center">Status</th>
                            </tr>
                            <tr class="">
                                <td class="text-center">${val.siswa.nama}</td>
                                <td class="text-center">${val.bayar}</td>
                                <td class="text-center">${val.spp}</td>
                                <td class="text-center">${val.sisa_bayar}</td>
                                <td class="text-center">${val.sisa_bayar > 0 ? '<span class="pending">Pending</span>' : '<span class="paid">Paid</span>'}</td>
                            </tr>
                        </table>
                        `)
                    })
                }else{
                    $('.shadow').css('opacity', '1');
                    $('.shadow').css('height', 'max-content');
                    $('.shadow').css('background-color', '#f8d7da')
                    $('.info-tagihan').children().remove()
                    $('.info-tagihan').append(`
                        <span class="text-danger">Anda belum membayar tagihan pada periode &nbsp;<strong>${bulanTxt} - ${tahun} </strong><span>
                    `)
                }
            })
        })
    </script>
@endsection
