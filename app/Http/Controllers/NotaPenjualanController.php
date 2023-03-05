<?php

namespace App\Http\Controllers;

use App\User;
use App\Barang;
use App\Customer;
use App\Pengguna;
use Carbon\Carbon;
use App\AkunAkuntansi;
use App\NotaPenjualan;
use App\JurnalAkuntansi;
use App\PeriodeAkuntansi;
use App\TransaksiAkuntansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotaPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = NotaPenjualan::all();
        $user = User::all();
        $customer = Customer::all();
        $barang = Barang::all();
        return view('notapenjualan.index', ['data' => $queryBuilder, 'user' => $user, 'barang' => $barang, 'customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $customer = Customer::all();
        $barang = Barang::all();
        $date_now = str_replace('-', '', Carbon::now()->toDateString());
        $sqlmaxnota = DB::select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PenjualanMaxTanggal FROM `nota_penjualan` WHERE `no_nota` LIKE '" . $date_now . "%';"));
        $jualMax = 0;
        if ($sqlmaxnota[0]->PenjualanMaxTanggal == null) {
            $jualMax = 1;
        } else {
            $jualMax = $sqlmaxnota[0]->PenjualanMaxTanggal;
        }
        $no_nota_generator = $date_now . '-' . '01' . '-' . '03' . '-' . str_pad($jualMax, 3, "0", STR_PAD_LEFT);
        return view('notapenjualan.create', ['date_now' => Carbon::now()->toDateString(), 'no_nota_generator' => $no_nota_generator, 'customer' => $customer, 'user' => $user, 'barang' => $barang]);
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
        if($request->get('no_nota_penjualan') != null){
            $data = new NotaPenjualan();
        
            $data->no_nota = $request->get('no_nota_penjualan');
            $data->tgl_pembuatan_nota = $request->get('tgl_transaksi');
            $data->cara_bayar = $request->get('cara_bayar');
    
            $data->total_harga = $request->get('total_harga_penjualan');
            // dd($request->get('total_harga_penjualan'));
            $data->pengguna_id = $user->id;
            // $data->customer_id = $request->get('customer_id');
            $customer = Customer::find($request->get('customer_id'));
    
            // // dd($customer);
            $customer->notapenjualan()->save($data);
            // dd($request->get("barang_penjualan"));
            foreach ($request->get("barang_penjualan") as $details) {
                // Update Kuantitas di barang
                $barang_update = Barang::find($details['id_barang']);
                $kuantitas_stok_ready_old = $barang_update->kuantitas_stok_ready;
                $kuantitas_stok_ready_new = $kuantitas_stok_ready_old  - $details['kuantitas'];
                $total_kuantitas_stok_old  = $barang_update->total_kuantitas_stok;
                $total_kuantitas_stok_new  = $total_kuantitas_stok_old - $details['kuantitas'];
    
                $barang_update->kuantitas_stok_ready = $kuantitas_stok_ready_new;
                $barang_update->total_kuantitas_stok = $total_kuantitas_stok_new;
                $barang_update->save();
    
                $data->barang()->attach($details['id_barang'], ['kuantitas' => $details['kuantitas'], 'harga' => $details['harga_barang']]);
            }
            $saved = $data->save();

            // Get Periode Aktif
            $perid = PeriodeAkuntansi::where('status', '1')->first();
            $periode_aktif_id = $perid->id;
            // Add Transaksi
            $cara_bayar =  $request->get('cara_bayar') == 'tunai' ? 101 : 102;
            $kategori_nota = $request->get('ketegori_nota');
            $kat_nota = AkunAkuntansi::find($request->get('ketegori_nota'));
            $customer2 = Customer::find($request->get('customer_id'));
            $ket = "Menjual ".$kat_nota->nama." Sebesar Rp ".number_format($request->get('total_harga_penjualan'))." Secara ".$request->get('cara_bayar')." Kepada ".$customer2->nama." ( ".$request->get('keterangan_penjualan')." )";
            
            $new_transaksi = new TransaksiAkuntansi();
            $new_transaksi->keterangan = $ket;
            $new_transaksi->save();
            $id_transaksi = $new_transaksi->id;

            // Jurnal Create
        
         
            $jurnal = new JurnalAkuntansi();
            $jurnal->jenis = "umum";
            $jurnal->tanggal_transaksi =$request->get('tgl_transaksi');
            $jurnal->no_bukti =$request->get('no_nota_penjualan');
            $jurnal->transaksi_id = $id_transaksi ;
            $jurnal->periode_id = $periode_aktif_id;
            $jurnal->save();
            $jurnal->akun()->attach($cara_bayar,['no_urut' =>1,'nominal_kredit' =>$request->get('total_harga_penjualan'),'nominal_debit'=>0]);
            $jurnal->akun()->attach($kategori_nota,['no_urut' =>2,'nominal_kredit' =>0,'nominal_debit'=>$request->get('total_harga_penjualan')]);

            return redirect()->route('notapenjualan.index')->with('status', 'Berhasil menambahkan nota ' . $request->get('no_nota_penjualan'));
        }
        else{
            return redirect()->route('nota.index')->with('error', 'Gagal menambahkan nota ');

        }
        // $data->save();
        // return redirect()->route('notapenjualan.index')->with('status', 'Berhasil menambahkan nota ' . $request->get('no_nota_penjualan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPenjualan $notaPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPenjualan $notaPenjualan)
    {
        return view('notapenjualan.edit', ['notapenjualan' => NotaPenjualan::find($notaPenjualan), 'customer' => Customer::All(), 'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPenjualan $notaPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPenjualan $notaPenjualan)
    {
        //
    }
    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = NotaPenjualan::find($id);
        $customer = Customer::all();
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('notapenjualan.getEditForm', compact('data', 'customer', 'barang'))->render()
        ), 200);
    }
}
