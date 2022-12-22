<?php

namespace App\Http\Controllers;

use App\NotaPembelian;
use App\Pengguna;
use App\Supplier;
use Illuminate\Http\Request;

class NotaPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = NotaPembelian::all();
        return view('notapembelian.index', ['data' => $queryBuilder]);
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
        return view('notapembelian.create', ['supplier' => $supplier],['pengguna' => $pengguna]);
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
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPembelian $notaPembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPembelian $notaPembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPembelian $notaPembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPembelian $notaPembelian)
    {
        //
    }
}
