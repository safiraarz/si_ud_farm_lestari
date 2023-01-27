<?php

namespace App\Http\Controllers;

use App\NotaPembelian;
use App\NotaPemesanan;
use App\Supplier;
use App\User;
use App\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $date_now = str_replace('-', '',Carbon::now()->toDateString());
        $sqlmaxnota = DB::select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PembelianMaxTanggal FROM `nota_pembelian` WHERE `no_nota` LIKE '". $date_now ."%';"));
        $pembelianMax= 0;
        if($sqlmaxnota[0]->PembelianMaxTanggal == null){
            $pembelianMax=1;
        }
        else{
            $pembelianMax = $sqlmaxnota[0]->PembelianMaxTanggal;
        }
        $no_nota_generator = $date_now.'-'.'01'.'-'.'02'.'-'.str_pad($pembelianMax, 3, "0", STR_PAD_LEFT);
        return view('notapembelian.index', ['no_nota_generator'=> $no_nota_generator,'data' => $queryBuilder, 'user' => $user,'supplier' => $supplier,'barang' => $barang,'notapemesanan' => $notapemesanan]);
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
        // dd($request->barang);
        $data = new NotaPembelian();
        $data->no_nota = $request->get('no_nota');

        $data->nota_pemesanan_id = $request->get('no_pesanan');
        $data->tgl_pembuatan_nota = $request->get('tanggal_pembuatan_nota');
        
        $supplier = Supplier::find($request->get('supplier_id'));
        $supplier->notapembelian()->save($data);
        $idNotaNew = $data->id;
        $total = 0;
        foreach($request->get("barang") as $details) 
        {
            $total += $details['kuantitas'] * $details['harga'];
            $data->barang()->attach($details['bahan_baku'],['kuantitas' =>$details['kuantitas'],'harga' =>$details['harga']]);
        }

        $data->total_harga = $total;
        $data->save();
      

        return redirect()->route('notapembelian.index')->with('status', 'Berhasil Menambahkan Nota ' . $request->get('no_nota'));
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
