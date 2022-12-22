<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\PemasukanTelur;
use App\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasukanTelurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = PemasukanTelur::all();
        $barang = Barang::all();
        $flok = Flok::all();

        // dd($queryBuilder);

        return view('pemasukantelur.index', ['data' => $queryBuilder,'barang'=>$barang,'flok'=>$flok]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $pengguna = Pengguna::all();
        $flok = Flok::all();
        return view('pemasukantelur.create', ['barang' => $barang],['pengguna' => $pengguna],['flok' => $flok]);
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
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanTelur $pemasukanTelur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function edit(PemasukanTelur $pemasukanTelur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemasukanTelur $pemasukanTelur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemasukanTelur $pemasukanTelur)
    {
        //
    }
}
