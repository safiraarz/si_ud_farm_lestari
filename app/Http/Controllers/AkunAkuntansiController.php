<?php

namespace App\Http\Controllers;

use App\AkunAkuntansi;
use Illuminate\Http\Request;

class AkunAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = AkunAkuntansi::all();
        return view('akun.index', ['data' => $queryBuilder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = ['aset','kewajiban','ekuitas','kewajiban','biaya'];
        return view("akun.create", compact('data','jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new AkunAkuntansi();
        $data->no_akun = $request->get('no_akun');
        $data->nama = $request->get('nama');
        $data->jenis_akun = $request->get('jenis_akun');
        $data->saldo_awal = $request->get('saldo_awal');
        $data->save();

        return redirect()->route('akun.index')->with('status', 'Akun berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AkunAkuntansi  $akunAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function show(AkunAkuntansi $akunAkuntansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AkunAkuntansi  $akunAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function edit(AkunAkuntansi $akunAkuntansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AkunAkuntansi  $akunAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AkunAkuntansi $akunAkuntansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AkunAkuntansi  $akunAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(AkunAkuntansi $akunAkuntansi)
    {
        //
    }
}
