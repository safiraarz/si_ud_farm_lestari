<?php

namespace App\Http\Controllers;

use App\PeriodeAkuntansi;
use Illuminate\Http\Request;

class PeriodeAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = PeriodeAkuntansi::all();
        return view('periode.index', ['data' => $queryBuilder]);
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
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function show(PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function edit(PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }
}
