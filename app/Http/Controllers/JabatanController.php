<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jabatan::all();
        return view('jabatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("jabatan.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Jabatan();
        $data->nama = $request->get('nama');
        $data->save();

        return redirect()->route('jabatan.index')->with('status', 'Jabatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', ['jabatan' => $jabatan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $jabatan->nama = $request->get('nama');
        $jabatan->save();
        return redirect()->route('jabatan.index')->with('status', 'Jabatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        try {
            $jabatan->delete();
            return redirect()->route('jabatan.index')->with('status', 'Berhasil menghapus jabatan');
        } catch (\Throwable $th) {
            $msg = "Gagal menghapus jabatan";
            return redirect()->route('jabatan.index')->with('status', 'Error ' . $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Jabatan::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('jabatan.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Jabatan = Jabatan::find($id);
        $Jabatan->nama = $request->get('nama');
        $Jabatan->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Jabatan berhasil diupdate'
            ),
            200
        );
    }
    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Jabatan = Jabatan::find($id);
            $Jabatan->delete();
            return response()->json(array(
                'status' => 'ok',
                'msg' => 'Jabatan berhasil dihapus'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status ' => ' error',
                'msg' => 'Jabatan tidak bisa dihapus. Jabatan diperlukan untuk data lain'
            ), 200);
        }
    }
    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');

        $Jabatan = Jabatan::find($id);
        $Jabatan->$fnama = $value;
        $Jabatan->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Jabatan berhasil diupdate'
            ),
            200
        );
    }
}
