<?php

namespace App\Http\Controllers;

use App\Barang;
use App\HasilProduksi;
use App\SPK;
use Illuminate\Http\Request;

class HasilProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = HasilProduksi::all();
        $barang = Barang::all();
        $spk = SPK::all();

        // dd($queryBuilder);

        return view('hasilproduksi.index', ['data' => $queryBuilder,'barang'=>$barang,'spk'=>$spk]);
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
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function show(HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilProduksi $hasilProduksi)
    {
        //
    }
}
