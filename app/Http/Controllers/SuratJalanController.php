<?php

namespace App\Http\Controllers;

use App\Barang;
use App\SuratJalan;
use App\User;
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = SuratJalan::all();
        $user = User::all();
        $barang = Barang::all();
        return view('suratjalan.index', ['data' => $queryBuilder, 'barang' => $barang, 'user' => $user]);
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
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratJalan $suratJalan)
    {
        //
    }
    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = SuratJalan::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('suratjalan.getEditForm', compact('data','barang'))->render()
        ), 200);
    }
}
