<?php

namespace App\Http\Controllers\Trs;

use App\Http\Controllers\Controller;
use App\Models\Mst\Bulan;
use App\Models\Mst\Siswa;
use App\Models\Trs\TransaksiInfo;
use App\Models\Trs\TransaksiSpp;
use App\Models\Trs\TransaksiSppHarga;
use Illuminate\Http\Request;

class TransaksiSppController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiSpp::with(['siswa', 'bulan'])->where('is_deleted', 0)->get();
        foreach($transaksi as $item) {
            $id_siswa_payment[] = $item->siswa->id;
        }
        if($transaksi->first() != null) {
            $siswa_unpaid = Siswa::whereNotIn('id', $id_siswa_payment)->get();
        }else{
            $siswa_unpaid = Siswa::all();
        }

        $spp = TransaksiSppHarga::all();
        $sppHarga = $spp->first()->harga_spp - ($spp->first()->harga_spp * $spp->first()->diskon / 100);

        return view('trs.transaksi_spp', [
            'transaksi' => $transaksi,
            'unpaid' => $siswa_unpaid,
            'spp' => $sppHarga,
        ]);
    }

    public function getSiswa($id)
    {
        $data = Siswa::where('is_deleted', 0)->where('id', $id)->get();

        return response()->json($data);
    }

    public function create($id)
    {
        $siswa = Siswa::where('is_deleted', 0)->where('id', $id)->get();
        $bulan = Bulan::all();

        return view('trs.form-transaksi-spp-add', [
            'siswa' => $siswa,
            'bulan' => $bulan
        ]);
    }

    public function store(Request $request)
    {
        $transaksi = new TransaksiSpp;
        $transaksi->no_transaksi = $request->no_transaksi;
        $transaksi->bayar = $request->dibayar;
        $transaksi->sisa_bayar = $request->sisa_bayar;
        $transaksi->tahun = $request->tahun;
        $transaksi->id_siswa = $request->siswa;
        $transaksi->id_bulan = $request->bulan;
        $transaksi->spp = $request->spp;
        if($request->sisa_bayar > 0) {
            $transaksi->is_pending = 1;
        }elseif($request->sisa_bayar <= 0) {
            $transaksi->is_paid = 1;
        }
        $transaksi->save();

        return redirect('/transaksi')->with([
            'success_add' => 'Transaksi berhasil',
        ]);
    }

    public function createSppHarga()
    {
        $checkDataSpp = TransaksiSppHarga::all();
        $harga = 0;
        $diskon = 0;
        if($checkDataSpp->first() != null) {
            $harga = $checkDataSpp->first()->harga_spp;
            $diskon = $checkDataSpp->first()->diskon;
        }

        return view('trs.set-harga-spp', [
            'harga' => $harga,
            'diskon' => $diskon
        ]);
    }

    public function setSppHarga(Request $request)
    {
        $checkDataSpp = TransaksiSppHarga::all();
        if($checkDataSpp->first() == null) {
            $sppHarga = new TransaksiSppHarga;
            $sppHarga->harga_spp = $request->spp;
            $sppHarga->diskon = $request->price;
            $sppHarga->save();
        }else{
            TransaksiSppHarga::truncate();

            $sppHarga = new TransaksiSppHarga;
            $sppHarga->harga_spp = $request->spp;
            $sppHarga->diskon = $request->price;
            $sppHarga->save();
        }
    }

    public function getHargaSpp()
    {
        $data = TransaksiSppHarga::all();
        return response()->json($data);
    }

    public function edit($id)
    {
        $bulan = Bulan::all();
        $siswa = Siswa::with('transaksi')->whereHas('transaksi', function($query) use ($id) {
            $query->where('id_siswa', $id);
        })->get();

        return view('trs.form-transaksi-spp-edit', [
            'siswa' => $siswa,
            'bulan' => $bulan,
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaksi = TransaksiSpp::where('id_siswa', $id)->get();

        TransaksiSpp::find($transaksi->first()->id)->update([
            'no_transaksi' => $request->no_transaksi,
            'bayar' => $request->dibayar,
            'sisa_bayar' => $request->sisa_bayar,
            'tahun' => $request->tahun,
            'id_siswa' => $request->siswa,
            'id_bulan' => $request->bulan,
            'spp' => $request->spp,
        ]);

        if($request->sisa_bayar > 0) {
            TransaksiSpp::find($transaksi->first()->id)->update([
                'is_pending' => 1
            ]);
        }elseif($request->sisa_bayar <= 0) {
            TransaksiSpp::find($transaksi->first()->id)->update([
                'is_paid' => 1
            ]);
        }

        return redirect('/transaksi')->with([
            'success_add' => 'Transaksi berhasil',
        ]);
    }
}
