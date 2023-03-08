<?php

namespace App\Http\Controllers;

use App\User;
use App\Barang;
use App\Supplier;
use Carbon\Carbon;
use App\AkunAkuntansi;
use App\NotaPembelian;
use App\NotaPemesanan;
use App\JurnalAkuntansi;
use App\PeriodeAkuntansi;
use App\TransaksiAkuntansi;
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
        $this->authorize('checknotapembelian');
        //ambil data
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

        if( $request->get('no_pesanan_pembelian') != null  && $request->get('ketegori_nota') != null){
            // $supplier2 = Supplier::find($request->get('supplier_id'));
            // dd($supplier2->nama);
            $data = new NotaPembelian();
            $data->no_nota = $request->get('no_nota');
            $data->nota_pemesanan_id = $request->get('no_pesanan_pembelian');
            $data->tgl_pembuatan_nota = $request->get('tanggal_pembuatan_nota');
            $data->cara_bayar = $request->get('cara_bayar');
            $data->keterangan = $request->get('keterangan_pembelian');
            $data->pengguna_id = $user->id;
            $supplier = Supplier::find($request->get('supplier_id'));
            $supplier->notapembelian()->save($data);
            // $idNotaNew = $data->id;
            $total = 0;
            $pemesanan = NotaPemesanan::find($request->get('no_pesanan_pembelian'));
     
            foreach($request->get("barang") as $details) 
            {
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
            // update status di pemesanan
            $pemesanan2 = NotaPemesanan::find($request->get('no_pesanan_pembelian'));
            $pemesanan2->status = "beli";
            $pemesanan2->save();
    
            $data->total_harga = $total;
            $saved = $data->save();

            // Get Periode Aktif
            $perid = PeriodeAkuntansi::where('status', '1')->first();
            $periode_aktif_id = $perid->id;
            // Add Transaksi
            $cara_bayar_no_akun =  $request->get('cara_bayar') == 'tunai' ? 101 : 102;
            $cara_bayar_akun = AkunAkuntansi::where('periode_id',$periode_aktif_id)->where('no_akun',$cara_bayar_no_akun)->first();
            $cara_bayar_akun_id = $cara_bayar_akun->id;
            $kategori_nota = $request->get('ketegori_nota');
            $kat_nota = AkunAkuntansi::find($request->get('ketegori_nota'));
            $supplier2 = Supplier::find($request->get('supplier_id'));
            // dd($supplier2);
            $new_transaksi = new TransaksiAkuntansi();
            $ket = "Membeli ".$kat_nota->nama." sebesar Rp ".number_format($total)." secara ".$request->get('cara_bayar')." kepada ".$supplier2->nama.". ".$request->get('keterangan_pembelian');        
            $new_transaksi->keterangan = $ket;
            $new_transaksi->save();
            $id_transaksi = $new_transaksi->id;

            // Jurnal Create
        
            $jurnal = new JurnalAkuntansi();
            $jurnal->jenis = "umum";
            $jurnal->tanggal_transaksi =$request->get('tanggal_pembuatan_nota');
            $jurnal->no_bukti =$request->get('no_nota');
            $jurnal->transaksi_id = $id_transaksi ;
            $jurnal->periode_id = $periode_aktif_id;
            $jurnal->save();
            $jurnal->akun()->attach($cara_bayar_akun_id,['no_urut' =>1,'nominal_kredit' =>$total,'nominal_debit'=>0]);
            $jurnal->akun()->attach($kategori_nota,['no_urut' =>2,'nominal_kredit' =>0,'nominal_debit'=>$total]);


            return redirect()->route('notapembelian.index')->with('status', 'Berhasil menambahkan nota ' . $request->get('no_nota'));
        }
        else{
            return redirect()->route('nota.index')->with('error', 'Gagal menambahkan nota ');

        }
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
}
