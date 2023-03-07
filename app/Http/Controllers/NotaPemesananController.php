<?php

namespace App\Http\Controllers;

use App\Barang;
use App\NotaPemesanan;
use App\Supplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class NotaPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('checknotapemesanan');

        $queryBuilder = NotaPemesanan::orderby('id','DESC')->get();
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
        $barang = Barang::all();
        $date_now = str_replace('-', '',Carbon::now()->toDateString());
        $sqlmaxnota = DB::select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PemesananMaxTanggal FROM `nota_pemesanan` WHERE `no_nota` LIKE '". $date_now ."%';"));
        $pemesanMax= 0;
        if($sqlmaxnota[0]->PemesananMaxTanggal == null){
            $pemesanMax=1;
        }
        else{
            $pemesanMax = $sqlmaxnota[0]->PemesananMaxTanggal;
        }
        $no_nota_generator = $date_now.'-'.'01'.'-'.'01'.'-'.str_pad($pemesanMax, 3, "0", STR_PAD_LEFT);
        return view('notapemesanan.create', ['date_now'=>Carbon::now()->toDateString(),'no_nota_generator'=>$no_nota_generator,'supplier' => $supplier,'user' => $user,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if($request->get('no_nota')!= null){
            $data = new NotaPemesanan();
            $data->no_nota = $request->get('no_nota');
            $data->tgl_pembuatan_nota = $request->get('tgl_transaksi');
            $data->total_harga = $request->get('total_harga');
            $data->pengguna_id = $user->id;
            $supplier = Supplier::find($request->get('supplier_id'));
            $supplier->notapemesanan()->save($data);
            foreach($request->get("barang") as $details) 
            {   
                // Update Kuantitas di barang
                $barang_update = Barang::find($details['id_barang']);
                $kuantitas_stok_onorder_supplier_old = $barang_update->kuantitas_stok_onorder_supplier;
                $kuantitas_stok_onorder_supplier_new = $kuantitas_stok_onorder_supplier_old + $details['kuantitas'];
                $total_kuantitas_stok_old  = $barang_update->total_kuantitas_stok;
                $total_kuantitas_stok_new  = $total_kuantitas_stok_old + $details['kuantitas'];
                
                $barang_update->kuantitas_stok_onorder_supplier = $kuantitas_stok_onorder_supplier_new;
                $barang_update->total_kuantitas_stok = $total_kuantitas_stok_new;
                $barang_update->save();
    
                $data->barang()->attach($details['id_barang'],['kuantitas' =>$details['kuantitas'],'harga' =>$details['harga_barang']]);
                
            }
            $data->save();
            return redirect()->route('notapemesanan.index')->with('status', 'Berhasil Menambahkan Nota '  . $request->get('no_nota'));    
        }
        else{
            return redirect()->route('nota.index')->with('error', 'Gagal Menambahkan Nota ');    
        }
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPemesanan  $notaPemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$notaPemesanan)
    {
        
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
}
