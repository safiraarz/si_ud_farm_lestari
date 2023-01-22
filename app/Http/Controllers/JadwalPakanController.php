<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\JadwalPakan;
use App\User;
use Illuminate\Http\Request;

class JadwalPakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = JadwalPakan::all();
        $barang = Barang::all();
        $flok = Flok::all();
        $user = User::all();
        // dd($queryBuilder);

        return view('jadwalpakan.index', [
            'data' => $queryBuilder, 'barang' => $barang, 'flok' => $flok, 'user' => $user
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalPakan $jadwalPakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalPakan $jadwalPakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JadwalPakan $jadwalPakan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalPakan $jadwalPakan)
    {
        //
    }
}
