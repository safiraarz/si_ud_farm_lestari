<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\JadwalPakan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalPakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = JadwalPakan::orderBy('created_at', 'desc')->get();
        $barang = Barang::all();
        $flok = Flok::all();
        $user = User::all();
        // dd($queryBuilder);

        return view('jadwalpakan.index', [
            'data' => $queryBuilder, 'barang' => $barang, 'flok' => $flok, 'user' => $user
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
        $user = Auth::user();
        $data = new JadwalPakan();
    
        $data->tgl_pemberian = $request->get('tgl_pemberian');
        $data->barang_id= $request->get('jenis_pakan');
        $data->flok_id= $request->get('asal_flok');
        $data->kuantitas = $request->get('kuantitas');
        $data->keterangan = $request->get('keterangan');
        $data->pengguna_id = $user->id;
        $data->save();

        //berkurang stok
        $barang_update = Barang::find('barang_id');
        $kuantitas_stok_ready_old = $barang_update->kuantitas_stok_ready;
        $kuantitas_stok_ready_new = $kuantitas_stok_ready_old  - 'kuantitas';
        $total_kuantitas_stok_old  = $barang_update->total_kuantitas_stok;
        $total_kuantitas_stok_new  = $total_kuantitas_stok_old - 'kuantitas';

        $barang_update->kuantitas_stok_ready = $kuantitas_stok_ready_new;
        $barang_update->total_kuantitas_stok = $total_kuantitas_stok_new;
        $barang_update->save();

        return redirect()->route('jadwalpakan.index')->with('status', 'Berhasil Menambahkan Jadwal Pakan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalPakan $jadwalPakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalPakan $jadwalPakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jadwalPakan)
    {
        //
        DB::table('jadwal_pakan')
        ->where('created_at', $jadwalPakan)
        ->update([
            'barang_id' => $request->get('jenis_pakan'),
            'flok_id' =>$request->get('asal_flok'),
            'tgl_pemberian' => $request->get('tgl_pemberian'),
            'kuantitas' => $request->get('kuantitas'),
        ]);

        return redirect()->route('jadwalpakan.index')->with('status', 'Berhasil Mengubah Jadwal Pakan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalPakan  $jadwalPakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalPakan $jadwalPakan)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $data = JadwalPakan::where('created_at',$request->get('id'))->first();
        // dd($data);

        $barang = Barang::all();
        $flok = Flok::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('jadwalpakan.getEditForm', compact('data', 'flok','barang'))->render()
        ), 200);
    }
    
}
