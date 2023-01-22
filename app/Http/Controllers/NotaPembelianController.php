<?php

namespace App\Http\Controllers;

use App\NotaPembelian;
use App\NotaPemesanan;
use App\Supplier;
use App\User;
use App\Barang;
use Illuminate\Http\Request;

class NotaPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = NotaPembelian::all();
        $user = User::all();
        $supplier = Supplier::all();
        $barang = Barang::all();
        $notapemesanan = NotaPemesanan::all();
        return view('notapembelian.index', ['data' => $queryBuilder, 'user' => $user,'supplier' => $supplier,'barang' => $barang,'notapemesanan' => $notapemesanan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $supplier = Supplier::all();
        $barang = Barang::all();
        $notapemesanan = NotaPemesanan::all();
        return view('notapembelian.create', ['supplier' => $supplier, 'user' => $user,'barang' => $barang,'notapemesanan' => $notapemesanan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new NotaPemesanan();
        $data->no_nota = $request->get('no_nota');
        $data->	tanggal_pembuatan_nota = $request->get('tanggal_pembuatan_nota');
        $data->total_harga = $request->get('total_harga');
        $data->	status = $request->get('status');

        $supplier = Supplier::find($request->get('supplier'));
        $barang = Barang::find($request->get('barang'));
        $notapemesanan = NotaPemesanan::find($request->get('nota_pemesanan'));

        $supplier->notapembelian()->save($data);
        $barang->notapembelian()->save($data);
        $notapemesanan->notapembelian()->save($data);

        return redirect()->route('notapembelian.index')->with('status', 'Berhasil menambahkan nota' . $request->get('no_nota'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPembelian $notaPembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPembelian $notaPembelian)
    {
        return view('notapembelian.edit', ['notapembelian' => NotaPemesanan::find($notaPembelian), 'supplier' => Supplier::All(),'barang' => Barang::All(), 'nota_pemesanan' => NotaPemesanan::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPembelian $notaPembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPembelian  $notaPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPembelian $notaPembelian)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = NotaPembelian::find($id);
        $supplier = Supplier::all();
        $barang = Barang::all();
        $notapemesanan = NotaPemesanan::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('notapembelian.getEditForm', compact('data', 'supplier','barang','notapemesanan'))->render()
        ), 200);
    }
}
