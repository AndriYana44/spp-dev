<?php

namespace App\Http\Controllers\Mst;

use App\Http\Controllers\Controller;
use App\Models\Mst\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('mst.jurusan.jurusan', [
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $jurusan = new Jurusan;
        $jurusan->id_jurusan = $request->id_jurusan;
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();

        return redirect()->back()->with([
            'success_add' => 'Data berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Jurusan::find($id)->update([
            'id_jurusan' => $request->id_jurusan,
            'jurusan' => $request->jurusan
        ]);

        return redirect('/jurusan')->with([
            'success_edit' => 'Data berhasil diubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jurusan::find($id)->delete();
        return redirect('/jurusan')->with([
            'success_del' => 'Data berhasil di hapus',
        ]);
    }
}
