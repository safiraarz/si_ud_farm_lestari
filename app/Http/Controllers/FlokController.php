<?php

namespace App\Http\Controllers;

use App\Flok;
use App\Barang;
use Illuminate\Http\Request;

class FlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Flok::all();
        $barang = Barang::all();
        return view('flok.index', compact('data','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("flok.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Flok();
        $data->nama = $request->get('nama');
        $data->keterangan = $request->get('keterangan');
        $data->cage = $request->get('cage');
        $data->strain = $request->get('strain');
        $data->karantina = $request->get('karantina');
        $data->afkir = $request->get('afkir');
        $data->sehat = $request->get('sehat');
        $data->populasi = $request->get('populasi');
        $data->usia = $request->get('usia');
        $data->barang_id = $request->get('pakan');
        $data->kebutuhan_pakan = $request->get('kebutuhan_pakan');
        $data->satuan = $request->get('satuan');
        $data->save();

        return redirect()->route('flok.index')->with('status', 'Flok '.$data->nama.' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flok  $flok
     * @return \Illuminate\Http\Response
     */
    public function show(Flok $flok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flok  $flok
     * @return \Illuminate\Http\Response
     */
    public function edit(Flok $flok)
    {
        return view('flok.edit', ['flok' => $flok]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flok  $flok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $flok)
    {
        $flok =  Flok::find($flok);
        $flok->keterangan = $request->get('keterangan');
        $flok->cage = $request->get('cage');
        $flok->strain = $request->get('strain');
        $flok->karantina = $request->get('karantina');
        $flok->afkir = $request->get('afkir');
        $flok->sehat = $request->get('sehat');
        $flok->populasi = $request->get('populasi');
        $flok->barang_id = $request->get('pakan');



        $flok->usia = $request->get('usia');
        $flok->kebutuhan_pakan = $request->get('kebutuhan_pakan');
        $flok->satuan = $request->get('satuan');


        $flok->save();
        return redirect()->route('flok.index')->with('status', 'Flok '.$flok->nama.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flok  $flok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flok $flok)
    {

    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Flok::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('flok.getEditForm', compact('data','barang'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Flok = Flok::find($id);
        $Flok->nama = $request->get('nama');
        $Flok->keterangan = $request->get('keterangan');
        $Flok->cage = $request->get('cage');
        $Flok->strain = $request->get('strain');
        $Flok->populasi = $request->get('populasi');
        $Flok->usia = $request->get('usia');
        $Flok->kebutuhan_pakan = $request->get('kebutuhan_pakan');
        $Flok->satuan = $request->get('satuan');
        $Flok->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Flok '.$Flok->nama.' berhasil diubah'
            ),
            200
        );
    }
    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Flok = Flok::find($id);
            $Flok->delete();
            return response()->json(array(
                'status' => 'ok',
                'msg' => 'Flok berhasil dihapus'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status ' => ' error',
                'msg' => 'Flok tidak bisa dihapus. Flok diperlukan untuk data lain'
            ), 200);
        }
    }
    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');

        $Flok = Flok::find($id);
        $Flok->$fnama = $value;
        $Flok->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Flok berhasil diupdate'
            ),
            200
        );
    }
}
