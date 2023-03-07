<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Customer;
use App\Supplier;
use Carbon\Carbon;
use App\AkunAkuntansi;
use App\NotaPemesanan;
use App\PeriodeAkuntansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('checktambahnota');
        $perid = PeriodeAkuntansi::where('status', '1')->first();
        $periode_aktif_id = $perid->id;
        $akun = AkunAkuntansi::where('periode_id',$periode_aktif_id)->get();
        $supplier = Supplier::all();
        $barang = Barang::all();
        $customer = Customer::all();
        $notapemesanan = NotaPemesanan::all();
        $date_now = str_replace('-', '',Carbon::now()->toDateString());
        // Generate No Nota Pemesanan
        $sqlmaxnota_pemesanan = DB::connection('inventory')->select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PemesananMaxTanggal FROM `nota_pemesanan` WHERE `no_nota` LIKE '". $date_now ."%';"));
        $pembelianMaxPemesanan= 0;
        if($sqlmaxnota_pemesanan[0]->PemesananMaxTanggal == null){
            $pembelianMaxPemesanan=1;
        }
        else{
            $pembelianMaxPemesanan = $sqlmaxnota_pemesanan[0]->PemesananMaxTanggal;
        }
        $no_nota_generator_pemesanan = $date_now.'-'.'01'.'-'.str_pad($pembelianMaxPemesanan, 3, "0", STR_PAD_LEFT);
        // Generate No Nota Pembelian
        $sqlmaxnota_pembelian = DB::connection('inventory')->select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PembelianMaxTanggal FROM `nota_pembelian` WHERE `no_nota` LIKE '". $date_now ."%';"));
        $pembelianMax_pembelian= 0;
      
        if($sqlmaxnota_pembelian[0]->PembelianMaxTanggal == null){
            $pembelianMax_pembelian=1;
        }
        else{
            $pembelianMax_pembelian = $sqlmaxnota_pembelian[0]->PembelianMaxTanggal;
        }
        $no_nota_generator_pembelian = $date_now.'-'.'02'.'-'.str_pad($pembelianMax_pembelian, 3, "0", STR_PAD_LEFT);
         // Generate No Nota Penjualan
        $sqlmaxnota_penjualan = DB::connection('inventory')->select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PenjualanMaxTanggal FROM `nota_penjualan` WHERE `no_nota` LIKE '". $date_now ."%';"));
        $pembelianMax_penjualan= 0;
      
        if($sqlmaxnota_penjualan[0]->PenjualanMaxTanggal == null){
            $pembelianMax_penjualan=1;
        }
        else{
            $pembelianMax_penjualan = $sqlmaxnota_penjualan[0]->PenjualanMaxTanggal;
        }
        $no_nota_generator_penjualan = $date_now.'-'.'03'.'-'.str_pad($pembelianMax_penjualan, 3, "0", STR_PAD_LEFT);
        
        return view('nota.tambah', [
            'customer' => $customer,
            'barang' => $barang,
            'supplier'=>$supplier,
            'notapemesanan' => $notapemesanan,
            'akun' => $akun,
            'no_nota_pemesanan'=>$no_nota_generator_pemesanan,
            'no_nota_pembelian'=>$no_nota_generator_pembelian,
            'no_nota_penjualan'=> $no_nota_generator_penjualan,
            'date_now' => Carbon::now()->toDateString()

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
