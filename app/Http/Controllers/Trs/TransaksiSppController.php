<?php

namespace App\Http\Controllers\Trs;

use App\Http\Controllers\Controller;
use App\Models\Mst\Bulan;
use App\Models\Mst\Siswa;
use App\Models\TahunPeriode;
use App\Models\Trs\TransaksiInfo;
use App\Models\Trs\TransaksiSpp;
use App\Models\Trs\TransaksiSppHarga;
use App\Models\User_r;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiSppController extends Controller
{
    public function index(Request $request)
    {
        $periode = TahunPeriode::where('is_set', 1)->get();
        $bulan = Bulan::where('id', $request->bulan)->get();
        $transaksi = TransaksiSpp::with(['siswa', 'bulan', 'tahun'])
            ->where('is_deleted', 0)
            ->whereHas('tahun', function ($q) {
                $q->where('is_set', 1);
            })->get();

        if ($request->bulan != null) {
            $transaksi = TransaksiSpp::with(['siswa', 'bulan', 'tahun'])
                ->where('is_deleted', 0)
                ->where('id_bulan', $request->bulan)
                ->whereHas('tahun', function ($q) {
                    $q->where('is_set', 1);
                })->get();
        }

        foreach ($transaksi as $item) {
            $id_siswa_payment[] = $item->siswa->id;
        }
        if ($transaksi->first() != null) {
            $siswa_unpaid = Siswa::whereNotIn('id', $id_siswa_payment)->get();
        } else {
            $siswa_unpaid = Siswa::all();
        }

        $spp = TransaksiSppHarga::with(['bulan'])->where('id_tahun', $periode->first()->id)->get();
        if ($spp->first() != null) {
            $sppHarga = $spp->first()->harga_spp - ($spp->first()->harga_spp * $spp->first()->diskon / 100);
        } else {
            $sppHarga = '';
        }

        $data_periode = TransaksiSppHarga::with(['tahun', 'bulan'])->get();

        return view('trs.transaksi_spp', [
            'transaksi' => $transaksi,
            'unpaid' => $siswa_unpaid,
            'spp' => $sppHarga,
            'periode' => $periode,
            'bulan' => $spp,
            'periode_bulan' => $bulan,
            'data_periode' => $data_periode
        ]);
    }

    public function getSiswa($id)
    {
        $data = Siswa::where('is_deleted', 0)->where('id', $id)->get();

        return response()->json($data);
    }

    public function create($id)
    {
        $periode_set = TahunPeriode::where('is_set', 1)->get();
        $periode = TransaksiSppHarga::with(['tahun', 'bulan'])->where('id_tahun', $periode_set->first()->id)->get();
        $siswa = Siswa::where('is_deleted', 0)->where('id', $id)->get();
        $bulan = Bulan::all();

        return view('trs.form-transaksi-spp-add', [
            'siswa' => $siswa,
            'bulan' => $bulan,
            'periode' => $periode,
            'periode_set' => $periode_set
        ]);
    }

    public function store(Request $request)
    {
        $transaksi = new TransaksiSpp;
        $transaksi->no_transaksi = $request->no_transaksi;
        $transaksi->bayar = $request->dibayar;
        $transaksi->sisa_bayar = $request->sisa_bayar;
        $transaksi->id_tahun = $request->tahun;
        $transaksi->id_siswa = $request->siswa;
        $transaksi->id_bulan = $request->bulan;
        $transaksi->spp = $request->spp;
        if ($request->sisa_bayar > 0) {
            $transaksi->is_pending = 1;
        } elseif ($request->sisa_bayar <= 0) {
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
        if ($checkDataSpp->first() != null) {
            $harga = $checkDataSpp->first()->harga_spp;
            $diskon = $checkDataSpp->first()->diskon;
        }

        $bulan = Bulan::all();

        return view('trs.set-harga-spp', [
            'harga' => $harga,
            'diskon' => $diskon,
            'bulan' => $bulan
        ]);
    }

    public function setSppHarga(Request $request)
    {
        $tahun = TahunPeriode::where('is_set', 1)->get();
        $bulan = Bulan::all();
        $validasi = TransaksiSppHarga::where('id_bulan', $request->bulan)
            ->where('id_tahun', $request->tahun)->get();
        if ($validasi->count() > 0) {
            return redirect('/transaksi/set-harga-spp')->with([
                'failed' => 'Data pada periode ' . $bulan->where('id', $request->bulan)->first()->bulan . ' - ' . $tahun->first()->tahun . ' sudah ada',
            ]);
        } else {
            $sppHarga = new TransaksiSppHarga;
            $sppHarga->harga_spp = $request->spp;
            $sppHarga->diskon = $request->price;
            $sppHarga->id_bulan = $request->bulan;
            $sppHarga->id_tahun = $tahun->first()->id;
            $sppHarga->save();
        }

        return redirect('/transaksi/data-periode')->with([
            'success' => 'Spp berhasil ditetapkan',
        ]);
    }

    public function getHargaSpp($id_bulan, $id_tahun)
    {
        $data = TransaksiSppHarga::where('id_bulan', $id_bulan)->where('id_tahun', $id_tahun)->get();
        return response()->json($data);
    }

    public function edit($id)
    {
        $periode_set = TahunPeriode::where('is_set', 1)->get();
        $periode = TransaksiSppHarga::with(['tahun', 'bulan'])->where('id_tahun', $periode_set->first()->id)->get();
        $siswa = Siswa::with('transaksi')->whereHas('transaksi', function ($query) use ($id) {
            $query->where('id_siswa', $id);
        })->get();

        return view('trs.form-transaksi-spp-edit', [
            'siswa' => $siswa,
            'periode' => $periode,
            'periode_set' => $periode_set,
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
            'id_tahun' => $request->tahun,
            'id_siswa' => $request->siswa,
            'id_bulan' => $request->bulan,
            'spp' => $request->spp,
        ]);

        if ($request->sisa_bayar > 0) {
            TransaksiSpp::find($transaksi->first()->id)->update([
                'is_pending' => 1
            ]);
        } elseif ($request->sisa_bayar <= 0) {
            TransaksiSpp::find($transaksi->first()->id)->update([
                'is_paid' => 1
            ]);
        }

        return redirect('/transaksi')->with([
            'success_add' => 'Transaksi berhasil',
        ]);
    }

    public function getTransaksi($id)
    {
        $transaksi = TransaksiSpp::with('siswa')->where('id', $id)->get();

        return response()->json($transaksi);
    }

    public function tagihan($id)
    {
        $bulan = Bulan::all();
        $tahun = DB::table('trs_transaksi_spp')
            ->selectRaw('DISTINCT(tahun) as tahun')
            ->get();

        $user = User_r::where('id_user', $id)->get();
        $user = $user->first()->id_siswa;
        $siswa = Siswa::where('id', $user)->get();

        return view('trs.tagihan', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'siswa' => $siswa,
            'id' => $user
        ]);
    }

    public function getTagihan($id, $tahun, $bulan)
    {
        $tagihan = TransaksiSpp::with('siswa')->where([
            ['id_siswa', '=', $id],
            ['tahun', '=', $tahun],
            ['id_bulan', '=', $bulan]
        ])->get();

        return response()->json($tagihan);
    }

    public function dataPeriode()
    {
        $data = TransaksiSppHarga::with(['tahun', 'bulan'])->get();
        return view('trs.data-periode', [
            'data' => $data
        ]);
    }
}
