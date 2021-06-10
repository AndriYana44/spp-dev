<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaDetail;
use Illuminate\Http\Request;
use DataTables;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa/siswa');
    }

    public function dataSiswa()
    {
        $data = Siswa::where('is_deleted', 0)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($data) {
                $button = '<a href="#" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                <a href="#" class="btn btn-info btn-sm">Detail</a>';
                return $button;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function importCsv(Request $request)
    {
        // get file
        $upload = $request->file('upload_file');
        $filePath = $upload->getRealPath();
        // open and read
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        // validate
        foreach($header as $key => $value) {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            $escapedHeader[] = $escapedItem;
        }

        // looping through other columns
        while($columns = fgetcsv($file)) {
            if($columns[0] == "") {
                continue;
            }
            // trim data
            foreach($columns as $key => &$value) {
                $result[] = preg_replace('/\D+/', '', $value);
            }

            // dd($result);

            $data = array_combine($escapedHeader, $columns);
            // data for mst_siswa
            $nama = $data['nama'];
            $nis = $data['nis'];
            $nisn = $data['nisn'];
            $kelas = $data['kelas'];
            $jk = $data['jk'];
            $tgllahir = $data['tgllahir'];

            // data for mst_siswa_detail
            $kotalahir = $data['kotalahir'];
            $agama = $data['agama'];
            $alamat = $data['alamat'];
            $rt = $data['rt'];
            $rw = $data['rw'];
            $dusun = $data['dusun'];
            $kelurahan = $data['kelurahan'];
            $kecamatan = $data['kecamatan'];
            $pos = $data['pos'];
            $transportasi = $data['transportasi'];

            $siswa = new Siswa;
            $siswa->nama = $nama;
            $siswa->nis = $nis;
            $siswa->nisn = $nisn;
            $siswa->kelas = $kelas;
            $siswa->jk = $jk;
            $siswa->tgl_lahir = $tgllahir;
            $siswa->save();

            $siswa_detail = new SiswaDetail;
            $siswa_detail->kota_lahir = $kotalahir;
            $siswa_detail->agama = $agama;
            $siswa_detail->alamat = $alamat;
            $siswa_detail->rt = $rt;
            $siswa_detail->rw = $rw;
            $siswa_detail->dusun = $dusun;
            $siswa_detail->kelurahan = $kelurahan;
            $siswa_detail->kecamatan = $kecamatan;
            $siswa_detail->pos = $pos;
            $siswa_detail->transportasi = $transportasi;
            $siswa_detail->id_siswa = $siswa->id;
            $siswa_detail->save();

        }

        return redirect()->back()->with([
            'success_import' => 'Data berhasil di import',
        ]);

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
