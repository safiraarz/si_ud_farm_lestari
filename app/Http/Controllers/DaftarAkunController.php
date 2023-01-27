<?php

namespace App\Http\Controllers;

use App\DaftarAkun;
use Illuminate\Http\Request;

class DaftarAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DaftarAkun::all();
        return view('daftarakun.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("flok.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new DaftarAkun();
        $data->no_akun = $request->get('no_akun');
        $data->nama = $request->get('nama');
        $data->jenis_akun = $request->get('jenis_akun');
        $data->saldo_normal = $request->get('saldo_normal');
        $data->save();

        return redirect()->route('daftarakun.index')->with('status', 'Akun berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DaftarAkun  $daftarAkun
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarAkun $daftarAkun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DaftarAkun  $daftarAkun
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarAkun $daftarAkun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DaftarAkun  $daftarAkun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarAkun $daftarAkun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DaftarAkun  $daftarAkun
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarAkun $daftarAkun)
    {
        //
    }

    public function saveData(Request $request)
    {
        $id = $request->get('no_akun');
        $Flok = DaftarAkun::find($id);
        $Flok->nama = $request->get('nama');
        $Flok->jenis_akun = $request->get('jenis_akun');
        $Flok->saldo_normal = $request->get('saldo_normal');
        $Flok->strain = $request->get('strain');
        $Flok->populasi = $request->get('populasi');
        $Flok->usia_hari = $request->get('usia_hari');
        $Flok->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Flok berhasil diupdate'
            ),
            200
        );
    }
    public function saveDataField(Request $request)
    {
        $id = $request->get('no_akun');
        $fnama = $request->get('fnama');
        $value = $request->get('value');

        $Flok = DaftarAkun::find($id);
        $Flok->$fnama = $value;
        $Flok->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Akun berhasil diupdate'
            ),
            200
        );
    }
}
