<?php

namespace App\Http\Controllers;

use App\AkunAkuntansi;
use App\PeriodeAkuntansi;
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
        $this->authorize('checkakun');
        $perid = PeriodeAkuntansi::where('status', '1')->first();
        $periode_aktif_id = $perid->id;
        $queryBuilder = AkunAkuntansi::where('periode_id',$periode_aktif_id)->get();
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
