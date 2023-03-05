<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\PemasukanTelur;
use App\Pengguna;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemasukanTelurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = PemasukanTelur::all();
        $barang = Barang::all();
        $flok = Flok::all();
        $user = User::all();
        // foreach ($queryBuilder as $data){
        //     dd($data->barang);

        // }

        return view('pemasukantelur.index', ['data' => $queryBuilder, 'barang' => $barang, 'flok' => $flok, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $user = User::all();
        $flok = Flok::all();
        $date_now = str_replace('-', '', Carbon::now()->toDateString());
        return view('pemasukantelur.create', ['date_now' => Carbon::now()->toDateString(), 'barang' => $barang, 'user' => $user, 'flok' => $flok]);
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
        if($request->get("telur") != null){
            $data = new PemasukanTelur();
            $data->karantina = $request->get('karantina');
            $data->afkir = $request->get('afkir');
            $data->kematian = $request->get('kematian');
            $data->keterangan = $request->get('keterangan');
            $data->pengguna_id = $user->id;
            $data->flok_id = $request->get('flok');
            $data->tgl_pencatatan = Carbon::now()->toDateString();
            $data->save();
            
            foreach ($request->get("telur") as $details) {
                if($request->get('afkir') != null){

                    $barang_update = Barang::find($details['id_telur']);
                    $kuantitas_stok_ready_old = $barang_update->kuantitas_stok_ready;
                    $kuantitas_stok_ready_new = $kuantitas_stok_ready_old  + $details['kuantitas_bersih'];
                    $total_kuantitas_stok_old  = $barang_update->total_kuantitas_stok;
                    $total_kuantitas_stok_new  = $total_kuantitas_stok_old + $details['kuantitas_bersih'];
        
                    $barang_update->kuantitas_stok_ready = $kuantitas_stok_ready_new;
                    $barang_update->total_kuantitas_stok = $total_kuantitas_stok_new;
                    $barang_update->save();
                }
            
    
                $data->daftar_barang()->attach($details['id_telur'], [
                    'kuantitas_bersih' => $details['kuantitas_bersih'],
                    'kuantitas_reject' => $details['kuantitas_reject'],
                    'total_kuantitas' => $details['kuantitas_total']
                ]);
    
    
            }
            // FLok Manajement
            // Jika user masukin input AFKIR, menambah TABEL FLOK “afkir” dan mengurangi TABEL FLOK “sehat” dan menambah TABEL BARANG “stok ready” dan “total stok”
            if($request->get('afkir') != null){
                $flok = Flok::find($request->get('flok'));
                $afkir_old = $flok->afkir;
                $sehat_old = $flok->sehat;

                $afkir_new = $afkir_old + $request->get('afkir');
                $sehat_new = $sehat_old - $request->get('afkir');

                $flok->afkir = $afkir_new;
                $flok->sehat = $sehat_new;

                $flok->save();
            }

            // Jika user masukin input KARANTINA, maka menambah TABEL FLOK “karantina” dan mengurangi TABEL FLOK “sehat”
            if($request->get('karantina') != null){

                $flok = Flok::find($request->get('flok'));
                $karantina_old = $flok->karantina;
                $sehat_old = $flok->sehat;

                $karantina_new = $karantina_old + $request->get('karantina');
                $sehat_new = $sehat_old - $request->get('karantina');

                $flok->karantina = $karantina_new;
                $flok->sehat = $sehat_new;

                $flok->save();
            }
            // Jika user masukin input KEMATIAN, maka mengurangi TABEL FLOK “sehat” dan “afkir”
            if($request->get('kematian') != null){
                $flok = Flok::find($request->get('flok'));
                $afkir_old = $flok->afkir;
                $sehat_old = $flok->sehat;

                $afkir_new = $afkir_old - $request->get('kematian');
                $sehat_new = $sehat_old - $request->get('kematian');

                $flok->afkir = $karantina_new;
                $flok->sehat = $sehat_new;

                $flok->save();
            }
            // Update Flok Jika Kematian 
            

            return redirect()->route('pemasukantelur.index')->with('status', 'Pemasukan Telur ID '.$data->id.' berhasil ditambahkan');
        }
        else{
            return redirect()->route('pemasukantelur.create')->with('error', 'Gagal menambah pencatatan');

        }
       
        // $barang->pemasukantelur()->save($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanTelur $pemasukanTelur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function edit(PemasukanTelur $pemasukanTelur)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $pemasukanTelur)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemasukanTelur $pemasukanTelur)
    {
        //
    }
}
