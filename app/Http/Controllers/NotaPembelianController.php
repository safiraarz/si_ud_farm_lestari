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
use Illuminate\Support\Facades\Auth;

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
        // $date_now = str_replace('-', '',Carbon::now()->toDateString());
        // $sqlmaxnota = DB::select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PembelianMaxTanggal FROM `nota_pembelian` WHERE `no_nota` LIKE '". $date_now ."%';"));
        // $pembelianMax= 0;
        // if($sqlmaxnota[0]->PembelianMaxTanggal == null){
        //     $pembelianMax=1;
        // }
        // else{
        //     $pembelianMax = $sqlmaxnota[0]->PembelianMaxTanggal;
        // }
        // $no_nota_generator = $date_now.'-'.'01'.'-'.'02'.'-'.str_pad($pembelianMax, 3, "0", STR_PAD_LEFT);
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
        // dd($request->barang);
        // dd($request->get('ketegori_nota'));
        
        $user = Auth::user();
        if( $request->get('no_pesanan_pembelian') != null ){
            $data = new NotaPembelian();
            $data->no_nota = $request->get('no_nota');
            $data->nota_pemesanan_id = $request->get('no_pesanan_pembelian');
            $data->tgl_pembuatan_nota = $request->get('tanggal_pembuatan_nota');
            $data->cara_bayar = $request->get('cara_bayar');
            $data->pengguna_id = $user->id;
            $supplier = Supplier::find($request->get('supplier_id'));
            $supplier->notapembelian()->save($data);
            // $idNotaNew = $data->id;
            $total = 0;
            $pemesanan = NotaPemesanan::find($request->get('no_pesanan_pembelian'));
            // dd($pemesanan->barang);
            foreach($request->get("barang") as $details) 
            {
                if($request->get('asset_checked_form')==1){
    
                }
                foreach ($pemesanan->barang as $value) {
                    if($value->id == $details['barang_id']){
                        $kuantitas_old = $value->pivot->kuantitas;
                        $barang_update = Barang::find($details['barang_id']);
                        $barang_update->kuantitas_stok_onorder_supplier = $barang_update->kuantitas_stok_onorder_supplier - $kuantitas_old;
                        $barang_update->total_kuantitas_stok = ($barang_update->total_kuantitas_stok - $kuantitas_old) + $details['kuantitas'];
                        $barang_update->kuantitas_stok_ready = $barang_update->kuantitas_stok_ready + $details['kuantitas'];
                        $barang_update->save();
                    }
                }
                $total += $details['kuantitas'] * $details['harga'];
                $data->barang()->attach($details['barang_id'],['kuantitas' =>$details['kuantitas'],'harga' =>$details['harga']]);
            }
    
            $data->total_harga = $total;
            $saved = $data->save();
            return redirect()->route('notapembelian.index')->with('status', 'Berhasil menambahkan nota ' . $request->get('no_nota'));
        }
        else{
            return redirect()->route('nota.index')->with('error', 'Gagal menambahkan nota ');

        }

        // return redirect()->route('notapembelian.index')->with('status', 'Berhasil Menambahkan Nota ' . $request->get('no_nota'));
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
    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');
        $notaPembelian = NotaPembelian::find($id);
        $notaPembelian->$fnama = $value;
        $notaPembelian->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => strtoupper($fnama).' Nota Pembelian berhasil diupdate'
            ),
            200
        );
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
