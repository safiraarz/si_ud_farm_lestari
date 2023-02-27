<?php

namespace App\Http\Controllers;

use App\JurnalAkuntansi;
use App\PeriodeAkuntansi;
use Illuminate\Http\Request;

class ArusKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = PeriodeAkuntansi::all();
        $queryBuilder = JurnalAkuntansi::all();
        $arus_kas = new JurnalAkuntansi();
        // JurnalAkuntansi::bukubesar();
        // $buku_besar->jenis_saldo("");
        $arus_kas = $arus_kas->arus_kas();
        // dd($arus_kas);
        return view('aruskas.index', ['data' => $arus_kas,'periode'=>$periode]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
