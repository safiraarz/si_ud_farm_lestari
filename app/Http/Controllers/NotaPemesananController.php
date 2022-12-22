<?php

namespace App\Http\Controllers;

use App\Barang;
use App\NotaPemesanan;
use App\Pengguna;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = NotaPemesanan::all();
        return view('notapemesanan.index', ['data' => $queryBuilder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $pengguna = Pengguna::all();
        return view('notapemesanan.create', ['supplier' => $supplier],['pengguna' => $pengguna]);
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
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPemesanan $notaPemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPemesanan $notaPemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPemesanan $notaPemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPemesanan $notaPemesanan)
    {
        //
    }
}
