<?php

namespace App\Http\Controllers;

use App\Barang;
use App\NotaPemesanan;
use App\Supplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = NotaPemesanan::all();
        $user = User::all();
        $supplier = Supplier::all();
        $barang = Barang::all();

        return view('notapemesanan.index', ['data' => $queryBuilder,'user' => $user,'supplier' => $supplier,'barang' => $barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $user = User::all();
        $supplier = Supplier::all();
        $barang = Barang::all();
        return view('notapemesanan.create', ['supplier' => $supplier,'user' => $user,'supplier' => $supplier,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //belum
        $data = new NotaPemesanan();
        $data->no_nota = $request->get('no_nota');
        $data->	tanggal_pembuatan_nota = $request->get('tanggal_pembuatan_nota');
        $data->total_harga = $request->get('total_harga');
        $data->	status = $request->get('status');
        $supplier = Supplier::find($request->get('supplier'));
        $barang = Barang::find($request->get('barang'));
        $supplier->notapemesanan()->save($data);
        return redirect()->route('notapemesanan.index')->with('status', 'Berhasil menambahkan nota' . $request->get('no_nota'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPemesanan $notaPemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPemesanan $notaPemesanan)
    {
        return view('notapemesanan.edit', ['notapemesanan' => NotaPemesanan::find($notaPemesanan), 'supplier' => Supplier::All(),'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPemesanan $notaPemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPemesanan $notaPemesanan)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = NotaPemesanan::find($id);
        $supplier = Supplier::all();
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('notapemesanan.getEditForm', compact('data', 'supplier','barang'))->render()
        ), 200);
    }

    //masi belum
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

    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');


        $NotaPemesanan = NotaPemesanan::find($id);
        $NotaPemesanan->$fnama = $value;
        $NotaPemesanan->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'NotaPemesanan berhasil diupdate'
            ),
            200
        );
    }

    public function insertNota($nota, $user)
    {
        $total = 0;
        foreach ($nota as $id => $detail) {
            $total += $detail['harga'] * $detail['kuantitas'];
            $this->barang()->attach($id, ['kuantitas' => $detail['kuantitas'], 'subtotal' => $detail['price']]);
        }
        return $total;
    }

    public function submit_front()
    {
        $this->authorize('checkmember');

        $cart = session()->get('cart');
        // $user = Auth::user();
        $t = new NotaPemesanan();
        // $t->users_id = $user->id;
        $t->transaction_date = Carbon::now()->toDatetimeString();
        $t->save();

        // $total_harga = $t->insertProduct($cart, $user);
        $total_harga = $t->insertProduct($cart);
        $t->total = $total_harga;
        $t->save();

        session()->forget('cart');
        return redirect('home');
    }
}
