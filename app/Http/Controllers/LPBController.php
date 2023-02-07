<?php

namespace App\Http\Controllers;

use App\Barang;
use App\LPB;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LPBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = LPB::all();
        $barang = Barang::all();
        $user = User::all();
        return view('lpb.index', ['data' => $queryBuilder, 'barang' => $barang, 'user' => $user]);
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
        $date_now = str_replace('-', '', Carbon::now()->toDateString());
        $sqlmaxnota = DB::connection('inventory')->select(DB::raw(" SELECT MAX(SUBSTRING(no_surat, -3))+1 AS LPBMaxTanggal FROM `pengeluaran_bahan_baku` WHERE `no_surat` LIKE '" . $date_now . "%';"));
        $noSuratMax = 0;
        if ($sqlmaxnota[0]->LPBMaxTanggal == null) {
            $noSuratMax = 1;
        } else {
            $noSuratMax = $sqlmaxnota[0]->LPBMaxTanggal;
        }
        $no_surat_generator = $date_now . '-' . '02' . '-' . '02' . '-' . str_pad($noSuratMax, 3, "0", STR_PAD_LEFT);
        return view('lpb.create', ['date_now' => Carbon::now()->toDateString(), 'no_surat_generator' => $no_surat_generator, 'user' => $user, 'barang' => $barang]);
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
        $data = new LPB();
        $data->no_surat = $request->get('no_surat');
        $data->keterangan = $request->get('keterangan_input');
        $data->tgl_pengeluaran_barang = $request->get('tgl_pencatatan');
        $data->pengguna_id = $user->id;
        $data->save();

        // $barang = Barang::find($request->get('barang'));
        // dd($request->get('bahan_baku'));
        foreach ($request->get("bahan_baku") as $details) {
            $barang_update = Barang::find($details['id_bahan_baku']);
            $kuantitas_stok_ready_old = $barang_update->kuantitas_stok_ready;
            $kuantitas_stok_ready_new = $kuantitas_stok_ready_old  - $details['kuantitas'];
            $total_kuantitas_stok_old  = $barang_update->total_kuantitas_stok;
            $total_kuantitas_stok_new  = $total_kuantitas_stok_old - $details['kuantitas'];

            $barang_update->kuantitas_stok_ready = $kuantitas_stok_ready_new;
            $barang_update->total_kuantitas_stok = $total_kuantitas_stok_new;
            $barang_update->save();

            $data->daftar_barang()->attach($details['id_bahan_baku'], ['kuantitas' => $details['kuantitas']]);
        }
        // $barang->notapembelian()->save($data);
        return redirect()->route('lpb.index')->with('status', 'Berhasil menambah pencatatan ' . $request->get('no_surat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function show(LPB $lPB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function edit(LPB $lPB)
    {
        return view('lpb.edit', ['lpb' => LPB::find($lPB), 'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LPB $lPB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function destroy(LPB $lPB)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = LPB::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('lpb.getEditForm', compact('data', 'barang'))->render()
        ), 200);
    }
}
