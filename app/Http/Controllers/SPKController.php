<?php

namespace App\Http\Controllers;

use App\Barang;
use App\SPK;
use App\User;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = SPK::all();
        $user = User::all();
        $barang = Barang::all();
        return view('spk.index', ['data' => $queryBuilder,'barang' => $barang, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $barang = Barang::all();
        return view('spk.create', ['user' => $user,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new SPK();
        $data->no_nota = $request->get('no_nota');
        $data->	tgl_pembuatan_nota = $request->get('tgl_pembuatan_nota');
        $data->	tgl_pembuatan_nota = $request->get('tgl_pembuatan_nota');
        $data->	tgl_pembuatan_nota = $request->get('tgl_pembuatan_nota');
        $data->total_harga = $request->get('total_harga');
        $data->	status = $request->get('status');

        $barang = Barang::find($request->get('barang'));

        $barang->notapembelian()->save($data);

        return redirect()->route('spk.index')->with('status', 'Berhasil menambahkan surat' . $request->get('no_surat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function show(SPK $sPK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function edit(SPK $sPK)
    {
        return view('spk.edit', ['spk' => SPK::find($sPK),'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SPK $sPK)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function destroy(SPK $sPK)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = SPK::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('spk.getEditForm', compact('data', 'barang'))->render()
        ), 200);
    }
}
