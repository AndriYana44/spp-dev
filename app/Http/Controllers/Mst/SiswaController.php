<?php

namespace App\Http\Controllers\Mst;

use App\Http\Controllers\Controller;
use App\Models\Mst\Jurusan;
use App\Models\Mst\Kelas;
use App\Models\Mst\Siswa;
use App\Models\Mst\SiswaDetail;
use App\Models\User;
use App\Models\User_r;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        return view('mst/siswa/siswa');
    }

    public function dataSiswa()
    {
        $data = Siswa::where('is_deleted', 0)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($data) {
                $button = '<a href="/siswa/edit/'.$data->id.'" class="btn btn-warning btn-sm">Edit</a>
                <a href="/siswa/delete/'.$data->id.'" onclick="return confirm(\'Lanjutkan menghapus data?\')" class="btn btn-danger btn-sm">Delete</a>
                <a href="/siswa/detail/'.$data->id.'" class="btn btn-info btn-sm">Detail</a>';
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
            $nama = strtolower($data['nama']);
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

            $emailGenerate = (explode(" ",$nama));
            $emailGenerate = $emailGenerate[0].'.'.$nis.'@gmail.com';

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

            $user = new User;
            $user->name = $nama;
            $user->email = $emailGenerate;
            $user->username = $nis;
            $user->password = Hash::make(substr($nis, 0, 4));
            $user->save();

            $user_r = new User_r;
            $user_r->id_siswa = $siswa->id;
            $user_r->id_user = $user->id;
            $user_r->save();
        }

        return redirect()->back()->with([
            'success_import' => 'Data berhasil di import',
        ]);

    }

    public function create()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('mst.siswa.form-tambah-siswa', [
            'kelas' => $kelas,
            'jurusan' => $jurusan,
        ]);
    }

    public function store(Request $request)
    {
        $siswa = new Siswa;
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->kelas = $request->kelas.'-'.$request->jurusan;
        $siswa->jk = $request->jk;
        $siswa->tgl_lahir = $request->tglLahir;
        $siswa->save();

        $siswa_detail = new SiswaDetail;
        $siswa_detail->kota_lahir = $request->kota;
        $siswa_detail->agama = $request->agama;
        $siswa_detail->alamat = $request->alamat;
        $siswa_detail->rt = $request->rt;
        $siswa_detail->rw = $request->rw;
        $siswa_detail->dusun = $request->dusun;
        $siswa_detail->kelurahan = $request->kelurahan;
        $siswa_detail->kecamatan = $request->kecamatan;
        $siswa_detail->pos = $request->pos;
        $siswa_detail->transportasi = $request->transportasi;
        $siswa_detail->id_siswa = $siswa->id;
        $siswa_detail->save();

        $emailGenerate = (explode(" ",$request->nama));
        $emailGenerate = $emailGenerate[0].'.'.$request->nis.'@gmail.com';

        $user = new User;
        $user->name = $request->nama;
        $user->email = $emailGenerate;
        $user->username = $request->nis;
        $user->password = Hash::make(substr($request->nis, 0, 4));
        $user->save();

        $user_r = new User_r;
        $user_r->id_siswa = $siswa->id;
        $user_r->id_user = $user->id;
        $user_r->save();

        return redirect('/siswa')->with([
            'success_add' => 'Data berhasil ditambahkan',
        ]);
    }

    public function edit(Siswa $siswa, $id)
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswa = Siswa::where('id', $id)->get();

        return view('mst.siswa.form-edit-siswa', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ]);
    }

    public function update(Request $request, $id)
    {
        Siswa::find($id)->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'jk' => $request->jk,
            'tgl_lahir' => $request->tgl_lahir
        ]);

        return redirect('/siswa')->with([
            'success_edit' => 'Data berhasil diubah',
        ]);
    }

    public function destroy(Siswa $siswa, $id)
    {
        $data_id = User_r::where('id_siswa', $id)->get();
        $id_user = $data_id->first()->id_user;

        $siswa = Siswa::find($id)->delete();
        if($siswa) {
            $siswa_detail = SiswaDetail::where('id_siswa', $id)->delete();
            if($siswa_detail) {
                $user_r = User_r::where('id_siswa', $id);
                $user = User::find($id_user)->delete();
            }
        }

        return redirect('/siswa')->with([
            'success_del' => 'Data berhasil dihapus',
        ]);
    }
}
