<?php

namespace App\Http\Controllers;

use App\Barang;
use App\SuratJalan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = SuratJalan::all();
        $user = User::all();
        $barang = Barang::all();
        return view('suratjalan.index', ['data' => $queryBuilder, 'barang' => $barang, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $barang = Barang::all();
        $date_now = str_replace('-', '',Carbon::now()->toDateString());
        $sqlmaxnota = DB::connection('inventory')->select(DB::raw(" SELECT MAX(SUBSTRING(no_surat, -3))+1 AS SuratJalanMaxTanggal FROM `surat_jalan` WHERE `no_surat` LIKE '". $date_now ."%';"));
        $suratMax= 0;
        if($sqlmaxnota[0]->SuratJalanMaxTanggal == null){
            $suratMax=1;
        }
        else{
            $suratMax = $sqlmaxnota[0]->SuratJalanMaxTanggal;
        }
        $no_surat_generator = $date_now.'-'.'02'.'-'.'03'.'-'.str_pad($suratMax, 3, "0", STR_PAD_LEFT);
        return view('suratjalan.create', ['date_now'=>Carbon::now()->toDateString(),'no_surat_generator'=>$no_surat_generator,'user' => $user,'barang' => $barang]);
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
        if($request->get("barang_jadi") != null) {
            $data = new SuratJalan();
            $data->pengguna_id = $user->id;
            $data->no_surat = $request->get('no_surat');
            $data->keterangan = $request->get('keterangan_input');
            $data->tgl_pengiriman_barang = $request->get('tgl_pencatatan');
    
            // $barang = Barang::find($request->get('barang'));
            // dd($request->get('keterangan_input'));
            $data->save();
            foreach($request->get("barang_jadi") as $details) 
            {   
                $data->daftar_barang()->attach($details['id_barang_jadi'],['kuantitas' =>$details['kuantitas']]);
            }
            return redirect()->route('suratjalan.index')->with('status', 'Berhasil menambahkan surat ' . $request->get('no_surat'));
    
        }
        else{
            return redirect()->route('suratjalan.create')->with('error', 'Gagal menambahkan surat ');

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratJalan $suratJalan)
    {
        //
    }

    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');
        $suratjalan = SuratJalan::find($id);
        $suratjalan->$fnama = $value;
        $suratjalan->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => strtoupper($fnama).' Surat Jalan berhasil diupdate'
            ),
            200
        );
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = SuratJalan::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('suratjalan.getEditForm', compact('data','barang'))->render()
        ), 200);
    }
}
