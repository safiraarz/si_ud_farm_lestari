<?php

namespace App\Http\Controllers;

use App\Flok;
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
        return view('flok.index', compact('data'));
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
        $data->save();

        return redirect()->route('flok.index')->with('status', 'Flok berhasil ditambahkan');
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
    public function update(Request $request, Flok $flok)
    {
        $flok->nama = $request->get('nama');
        $flok->save();
        return redirect()->route('flok.index')->with('status', 'Flok berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flok  $flok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flok $flok)
    {
        try {
            $flok->delete();
            return redirect()->route('flok.index')->with('status', 'Berhasil menghapus flok');
        } catch (\Throwable $th) {
            $msg = "Gagal menghapus flok";
            return redirect()->route('flok.index')->with('status', 'Error ' . $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Flok::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('flok.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Flok = Flok::find($id);
        $Flok->nama = $request->get('nama');
        $Flok->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Flok berhasil diupdate'
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
