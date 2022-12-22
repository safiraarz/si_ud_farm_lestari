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
        $data->kuantitas_stok_ready = $request->get('kuantitas_stok_ready');
        $data->total_kuantitas_stok = $request->get('total_kuantitas_stok');
        $data->jenis = $request->get('jenis');
        $data->satuan = $request->get('satuan');
        $data->save();

        return redirect()->route('barang.index')->with('status', 'Barang berhasil ditambahkan');
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
        return view('barang.edit', ['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $barang->nama = $request->get('nama');
        $barang->harga = $request->get('harga');
        $barang->lead_time = $request->get('lead_time');
        $barang->kuantitas_stok_onorder_supplier = $request->get('kuantitas_stok_onorder_supplier');
        $barang->kuantitas_stok_onorder_produksi = $request->get('kuantitas_stok_onorder_produksi');
        $barang->kuantitas_stok_ready = $request->get('kuantitas_stok_ready');
        $barang->total_kuantitas_stok = $request->get('total_kuantitas_stok');
        $barang->jenis = $request->get('jenis'); //enum
        $barang->satuan = $request->get('satuan');
        $barang->save();
        return redirect()->route('barang.index')->with('status', 'Barang berhasil dupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return redirect()->route('barang.index')->with('status', 'Barang berhasil dihapus');
        } catch (\Throwable $th) {
            $msg = "Barang gagal dihapus";
            return redirect()->route('barang.index')->with('status', 'Error ' . $msg);
        }
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
        $Barang->kuantitas_stok_ready = $request->get('kuantitas_stok_ready');
        $Barang->total_kuantitas_stok = $request->get('total_kuantitas_stok');
        $Barang->jenis = $request->get('jenis'); //enum
        $Barang->satuan = $request->get('satuan');

        $Barang->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Barang berhasil diupdate'
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
    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');


        $Barang = Barang::find($id);
        $Barang->$fnama = $value;
        $Barang->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Barang berhasil diupdate'
            ),
            200
        );
    }
}
