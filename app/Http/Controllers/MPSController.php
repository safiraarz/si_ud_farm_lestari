<?php

namespace App\Http\Controllers;

use App\Barang;
use App\MPS;
use App\SPK;
use Illuminate\Http\Request;

class MPSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = MPS::all();
        $spk = SPK::all();
        $barang = Barang::all();
        return view('mps.index', ['data' => $queryBuilder,'barang' => $barang,'spk' => $spk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spk = SPK::all();
        $barang = Barang::all();
        return view('mps.create', ['spk' => $spk,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new MPS();
        $data->tgl_mulai_produksi = $request->get('tgl_mulai_produksi');
        $data->tgl_selesai_produksi = $request->get('tgl_selesai_produksi');
        $data->kuantitas_barang_jadi = $request->get('kuantitas_barang_jadi');
        // dd($request->get('category'));
        $spk = SPK::find($request->get('spk'));
        $spk->mps()->save($data);
        $barang = Barang::find($request->get('barang'));
        $barang->mps()->save($data);
        return redirect()->route('mps.index')->with('status', 'Success Add MPS');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function show(MPS $mPS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function edit(MPS $mPS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPS $mPS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function destroy(MPS $mPS)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = MPS::find($id);
        $barang = Barang::all();
        $spk = SPK::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('mps.getEditForm', compact('data', 'barang','spk'))->render()
        ), 200);
    }
}
