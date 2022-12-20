<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();
        return view('supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Supplier();
        $data->nama = $request->get('nama');
        $data->alamat = $request->get('alamat');
        $data->no_telepon = $request->get('no_telepon');
        $data->save();

        return redirect()->route('supplier.index')->with('status', 'Supplier berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->nama = $request->get('nama');
        $supplier->alamat = $request->get('alamat');
        $supplier->no_telepon = $request->get('no_telepon');
        $supplier->save();
        return redirect()->route('supplier.index')->with('status', 'Supplier berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return redirect()->route('supplier.index')->with('status', 'Berhasil menghapus supplier');
        } catch (\Throwable $th) {
            $msg = "Gagal menghapus supplier";
            return redirect()->route('supplier.index')->with('status', 'Error ' . $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Supplier::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('supplier.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Supplier = Supplier::find($id);
        $Supplier->nama = $request->get('nama');
        $Supplier->alamat = $request->get('alamat');
        $Supplier->no_telepon = $request->get('no_telepon');
        $Supplier->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Supplier berhasil diupdate'
            ),
            200
        );
    }
    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Supplier = Supplier::find($id);
            $Supplier->delete();
            return response()->json(array(
                'status' => 'ok',
                'msg' => 'Supplier berhasil dihapus'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status ' => ' error',
                'msg' => 'Supplier tidak bisa dihapus. Supplier diperlukan untuk data lain'
            ), 200);
        }
    }
    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');

        $Supplier = Supplier::find($id);
        $Supplier->$fnama = $value;
        $Supplier->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Supplier berhasil diupdate'
            ),
            200
        );
    }
}
