<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('checkbarang');
        $data = Barang::all();
        return view('barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = ['Bahan Baku','Barang Jadi'];
        return view("barang.create", compact('data','jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = new Barang();

        $data->nama = $request->get('nama');
        $data->harga = $request->get('harga');
        $data->lead_time = $request->get('lead_time');
        $data->kuantitas_stok_onorder_supplier = $request->get('kuantitas_stok_onorder_supplier');
        $data->kuantitas_stok_onorder_produksi = $request->get('kuantitas_stok_onorder_produksi');
        $data->kuantitas_stok_pengaman = $request->get('kuantitas_stok_pengaman');
        $data->kuantitas_stok_ready = $request->get('kuantitas_stok_ready');
        $data->total_kuantitas_stok = $request->get('total_kuantitas_stok');
        $data->jenis = $request->get('jenis');
        // dd($request->get('jenis'));
        $data->satuan = $request->get('satuan');
        $data->save();

        return redirect()->route('barang.index')->with('status', 'Barang '.$data->nama.' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $barang)
    {
        // dd($barang);
        $data = Barang::find($barang);
        $data->kuantitas_onorder_produksi = $request->get('kuantitas_onorder_produksi');
        $data->kuantitas_onorder_supplier = $request->get('kuantitas_onorder_supplier');
        $data->kuantitas_stok_pengaman = $request->get('kuantitas_stok_pengaman');
        $data->kuantitas_stok_ready = $request->get('kuantitas_stok_ready');
        $data->total_kuantitas_stok = $request->get('total_kuantitas_stok');
        $data->lead_time = $request->get('leadtime');
        $data->harga = $request->get('harga');
        $data->save();
        return redirect()->route('barang.index')->with('status', 'Barang '.$data->nama.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {

    }
    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Barang::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('barang.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Barang = Barang::find($id);
        $Barang->harga = $request->get('harga');
        $Barang->lead_time = $request->get('lead_time');
        $Barang->kuantitas_stok_onorder_supplier = $request->get('kuantitas_stok_onorder_supplier');
        $Barang->kuantitas_stok_onorder_produksi = $request->get('kuantitas_stok_onorder_produksi');
        $Barang->kuantitas_stok_pengaman = $request->get('kuantitas_stok_pengaman');
        $Barang->kuantitas_stok_ready = $request->get('kuantitas_stok_ready');
        $Barang->total_kuantitas_stok = $request->get('total_kuantitas_stok');
        $Barang->jenis = $request->get('jenis'); //enum
        $Barang->satuan = $request->get('satuan');

        $Barang->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Barang '.$Barang->nama.' berhasil diubah'
            ),
            200
        );
    }
    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Barang = Barang::find($id);
            $Barang->delete();
            return response()->json(array(
                'status' => 'ok',
                'msg' => 'Barang berhasil dihapus'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status ' => ' error',
                'msg' => 'Barang tidak bisa dihapus. Barang diperlukan untuk data lain'
            ), 200);
        }
    }
}
