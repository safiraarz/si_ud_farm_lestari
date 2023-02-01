<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BOM;
use Illuminate\Http\Request;

class BOMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = BOM::all();
        $barang = Barang::all();
        
        // dd($queryBuilder);
        return view('bom.index', ['data' => $queryBuilder,'barang' => $barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = BOM::all();
        $barang = Barang::all();

        return view('bom.create', ['barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new BOM();
        // dd($request->get("bahan_baku"));
        $data->kuantitas_barang_jadi = $request->get('kuantitas_pakan_input');
        // dd($request->get('kuantitas_pakan_input'));
        $data->save();
        $data->barang()->attach($request->get('nama_pakan_input'));
        foreach($request->get("bahan_baku") as $details) 
        {   
            $data->barang()->attach($details['id_bahan_baku'],['kuantitas_bahan_baku' =>$details['kuantitas']]);
        }
        return redirect()->route('bom.index')->with('status', 'Berhasil Menambahkan BOM ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function show(BOM $bOM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function edit(BOM $bOM)
    {
        return view('bom.edit', ['bom' => BOM::find($bOM),'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BOM $bOM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function destroy(BOM $bOM)
    {
        //
    }
}
