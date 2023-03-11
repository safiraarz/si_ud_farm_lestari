<?php

namespace App\Http\Controllers;

use App\JurnalAkuntansi;
use App\PeriodeAkuntansi;
use Illuminate\Http\Request;

class PerubahanEkuitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('checkakuntansi');

        $periode = PeriodeAkuntansi::all();
        $queryBuilder = new JurnalAkuntansi();
        // Get Periode Aktif
        $perid = PeriodeAkuntansi::where('status', '1')->first();
        $periode_aktif_id = $perid->id;
        $ekuitas = $queryBuilder->perubahanekuitas($periode_aktif_id);
        // dd($ekuitas);
        return view('perubahanekuitas.index', ['data' => $ekuitas,'periode'=>$periode,'perid'=>$perid]);
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
